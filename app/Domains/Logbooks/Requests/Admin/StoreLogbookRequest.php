<?php
namespace App\Domains\Logbooks\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogbookRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'       => 'required|string',
            'description' => 'sometimes|string',
        ];
    }

    public function data() : array
    {
        return $this->only([
            'title',
            'description',
        ]);
    }
}
