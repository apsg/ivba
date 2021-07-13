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
            'full_price'      => 'sometimes|nullable|numeric|min:0',
            'course_id'       => 'sometimes|nullable|array',
            'course_id.*'     => 'numeric',
            'message_email'   => 'sometimes|nullable|email',
            'message_subject' => 'sometimes|nullable|string',
            'message_body'    => 'sometimes|nullable|string',
            'redirect_url'    => 'sometimes|nullable|string',
            'campaign'        => 'sometimes|nullable|string',
        ];
    }

    public function getData()
    {
        return array_merge([
            'is_full_data_required' => false,
        ], $this->except(['_token', 'course_id']));
    }
}
