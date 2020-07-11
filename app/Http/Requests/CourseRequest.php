<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // zalogowany administrator
        return auth()->check() && auth()->user()->isadmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'price'     => 'required|numeric|min:0',
            'difficulty' => 'required|numeric|min:1|max:3',
            'image_id' => 'exists:images,id',
            'slug' => 'unique:courses,slug,' . ($this->route('course')->id ?? ''),
        ];
    }
}
