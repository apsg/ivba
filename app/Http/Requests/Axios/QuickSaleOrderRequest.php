<?php
namespace App\Http\Requests\Axios;

use App\Domains\Quicksales\Requests\BaseQuickSaleRequest;
use App\Http\Requests\HasCouponTrait;
use App\Repositories\UserRepository;
use App\User;

class QuickSaleOrderRequest extends BaseQuickSaleRequest
{
    use HasCouponTrait;

    public function rules()
    {
        return [
            'email' => 'required|email',
            'phone' => 'required|string|min:9',
            'name'  => 'required|string',
        ];
    }

    public function getUser() : User
    {
        $userRepository = app(UserRepository::class);

        $user = $userRepository->findByEmail($this->input('email', ''));
        if ($user === null) {
            $user = $userRepository->createAndSend($this->all(['name', 'email', 'phone']));
        }

        $user->update(array_filter($this->all(['street', 'postcode', 'city'])));

        return $user;
    }
}
