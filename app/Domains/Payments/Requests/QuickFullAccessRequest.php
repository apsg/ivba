<?php
namespace App\Domains\Payments\Requests;

use App\Coupon;
use App\Domains\Payments\Exceptions\UserExistsException;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class QuickFullAccessRequest extends FormRequest
{
    protected ?Coupon $coupon = null;

    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'code'  => 'nullable|string',
        ];
    }

    /**
     * @return Coupon|null
     */
    public function coupon(): ?Coupon
    {
        if ($this->coupon === null && $this->input('code')) {
            $this->coupon = Coupon::where('code', $this->input('code'))
                ->usable()
                ->first();
        }

        return $this->coupon;
    }

    public function resolveUser(): User
    {
        $repository = app(UserRepository::class);

        if ($this->user() !== null) {
            $attributes = $this->only(['phone', 'name']);
            $this->user()->update($attributes);

            return $this->user();
        }

        if ($repository->findByEmail($this->input('email'))) {
            throw new UserExistsException();
        }

        return $repository->createAndSend($this->only('email', 'name', 'phone'));
    }
}
