<?php
namespace App\Domains\Api\Controllers;

use App\Domains\Api\Requests\CheckUserRequest;
use App\Domains\Api\Transformers\CheckUserTransformer;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Fractalistic\ArraySerializer;

class UsersController extends Controller
{
    public function check(CheckUserRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if ($user === null) {
            return response('User not found', 404);
        }

        return fractal($user)
            ->transformWith(new CheckUserTransformer())
            ->serializeWith(new ArraySerializer());
    }
}
