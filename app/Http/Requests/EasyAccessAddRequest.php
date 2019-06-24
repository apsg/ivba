<?php
namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class EasyAccessAddRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'duration' => 'required|numeric|in:1,3,6',
        ];
    }

    public function all($keys = null)
    {
        return array_merge(parent::all($keys), $this->route()->parameters());
    }
}
