<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuickSaleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'            => 'required|string',
            'description'     => 'string',
            'rules_url'       => 'required|url',
            'price'           => 'required|numeric|min:0',
            'full_price'      => 'numeric|min:0',
            'course_id'       => 'required|numeric|exists:courses,id',
            'message_email'   => 'email',
            'message_subject' => 'string',
            'message_body'    => 'string',
        ];
    }
}
