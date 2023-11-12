<?php
namespace App\Http\Controllers;

use App\Domains\Quicksales\Requests\QuickSaleCouponRequest;
use App\Helpers\PayuPayment;
use App\Http\Requests\Axios\QuickSaleFinishRequest;
use App\Http\Requests\Axios\QuickSaleOrderRequest;
use App\Http\Requests\Axios\QuickSalePrevalidateRequest;
use App\Order;
use App\Payments\Tpay\TpayTransaction;
use App\QuickSale;
use App\Repositories\QuickSaleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class QuickSalesController extends Controller
{
    public function show(string $hash, QuickSaleRepository $repository)
    {
        $sale = $repository
            ->findByHash($hash)
            ->only(['id', 'price', 'full_price', 'name', 'description', 'rules_url', 'hash', 'is_full_data_required', 'has_coupons']);

        return view('quicksale')->with(compact('sale'));
    }

    public function order(
        string $hash,
        QuickSaleOrderRequest $request,
        QuickSaleRepository $repository,
        UserRepository $userRepository
    ) {
        /** @var QuickSale $sale */
        $sale = $repository->findByHash($hash);
        $user = $userRepository->findByEmail($request->input('email', ''));
        if ($user === null) {
            $user = $userRepository->createAndSend($request->all(['name', 'email', 'phone']));
            Auth::login($user);
        }

        $user->update(array_filter($request->all(['street', 'postcode', 'city'])));

        $order = $user->getCurrentOrder()->clear();
        $order->quick_sales()->save($sale);

        if ($request->couponById() !== null && $request->couponById()->isValidForQuickSale()) {
            $order->coupons()->save($request->couponById());
        }

        return [
                'order_id' => $order->id,
            ] + $this->generatePaymentsOptions($sale, $order);
    }

    public function prevalidate(QuickSalePrevalidateRequest $request)
    {
        return response()->json([], 200);
    }

    public function finish(
        string $hash,
        QuickSaleFinishRequest $request,
        QuickSaleRepository $repository,
        UserRepository $userRepository
    ) {
        $user = $userRepository->findByEmail($request->input('email', ''));
        $order = $user->getCurrentOrder();
        $quickSale = $repository->findByHash($hash);

        if ($order->id != $request->input('order')) {
            return response()->json([
                'Invalid order id',
            ], 422);
        }

        if ($order->quick_sales[0]->hash != $hash) {
            return response()->json([
                'Invalid order id',
            ], 422);
        }

        $transaction = new TpayTransaction($order);
        $url = $transaction->createTransaction(
            (int)$request->input('group'),
            $quickSale->redirect_url
        );

        return response()->json([
            'url' => $url,
        ]);
    }

    public function finishFree(string $hash, QuickSaleOrderRequest $request)
    {
        $order = $request->getUser()->getCurrentOrder()->clear();
        $order->quick_sales()->save($request->sale());
        $order->confirm();

        return response()->json([
            'url' => $request->sale()->redirect_url,
        ]);
    }

    private function generatePaymentsOptions(QuickSale $sale, Order $order) : array
    {
        $payments = [];

        if (empty($sale->payments) || in_array(QuickSaleRepository::PAYMENT_TPAY, $sale->payments)) {
            $payments[QuickSaleRepository::PAYMENT_TPAY] = [
                'use' => true,
            ];
        }

        if (!empty($sale->payments) && in_array(QuickSaleRepository::PAYMENT_PAYU, $sale->payments)) {
            $payments[QuickSaleRepository::PAYMENT_PAYU] = [
                'use' => true,
                'url' => (new PayuPayment())->getUrl($order),
            ];
        }

        return compact('payments');
    }

    public function checkCoupon(string $hash, QuickSaleCouponRequest $request)
    {
        if ($request->couponByCode() === null || !$request->couponByCode()->isValidForQuickSale()) {
            return [
                'id'       => null,
                'newPrice' => null,
                'valid'    => false,
            ];
        }

        return [
            'id'          => $request->couponByCode()->id,
            'newPrice'    => $request->couponByCode()->apply($request->sale()->price),
            'valid'       => true,
            'description' => $request->couponByCode()->description,
        ];
    }
}
