<?php
namespace App\Http\Requests\Axios;

use App\QuickSale;
use App\Repositories\QuickSaleRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class QuickSaleOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'phone' => 'required|string|min:9',
            'name'  => 'required|string',
        ];
    }

    public function sale() : QuickSale
    {
        return app(QuickSaleRepository::class)->findByHash($this->route('hash'));
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
