<?php

namespace App\Http\Controllers;

use App\Http\Requests\Axios\QuickSaleFinishRequest;
use App\Http\Requests\Axios\QuickSaleOrderRequest;
use App\Payments\Tpay\TpayTransaction;
use App\QuickSale;
use App\Repositories\QuickSaleRepository;
use App\Repositories\UserRepository;

class QuickSalesController extends Controller
{
    public function show(string $hash, QuickSaleRepository $repository)
    {
        $sale = $repository->findByHash($hash)
            ->only(['id', 'price', 'full_price', 'name', 'description', 'rules_url', 'hash']);

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
            $userRepository->createAndSend($request->all(['name', 'email', 'phone']));
        }

        $order = $user->getCurrentOrder()->clear();
        $order->quick_sales()->save($sale);

        return [
            'order_id' => $order->id,
        ];
    }

    public function finish(
        string $hash,
        QuickSaleFinishRequest $request,
        QuickSaleRepository $repository,
        UserRepository $userRepository
    ) {
        $user = $userRepository->findByEmail($request->input('email', ''));
        $order = $user->getCurrentOrder();

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
        $url = $transaction->createTransaction((int)$request->input('group'));

        return response()->json([
            'url' => $url,
        ]);
    }
}
