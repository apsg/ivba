<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'title'             => 'required',
            'description'       => 'required',
            'price'             => 'required|numeric|min:0',
            'difficulty'        => 'required|numeric|min:1|max:3',
            'image_id'          => 'exists:images,id',
            'slug'              => 'unique:courses,slug,' . ($this->route('course')->id ?? ''),
            'is_special_access' => 'boolean',
        ];
    }

    public function fields() : array
    {
        $fields = $this->all() + [
                'is_special_access' => false,
            ];

        if (empty($fields['slug'])) {
            $fields['slug'] = Str::slug($this->input('title'));
        }

        return $fields;
    }
}
