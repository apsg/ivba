<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccessRequest
 * @package App\Http\Requests\Admin
 *
 * @property int duration
 */
class AccessRequest extends FormRequest
{
    public function rules()
    {
        return [
            'duration' => 'required|numeric|min:1',
        ];
    }
}