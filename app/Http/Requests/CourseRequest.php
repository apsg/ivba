<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        // zalogowany administrator
        return auth()->check() && auth()->user()->isadmin;
    }

    public function rules()
    {
        return [
            'title'             => 'required',
            'description'       => 'required',
            'price'             => 'required|numeric|min:0',
            'price_full'        => 'required|numeric|min:0',
            'payment_link'      => 'nullable|url',
            'difficulty'        => 'required|numeric|min:1|max:3',
            'image_id'          => 'exists:images,id',
            'slug'              => 'unique:courses,slug,' . ($this->route('course')->id ?? ''),
            'is_special_access' => 'boolean',
            'author_id'         => 'nullable|exists:authors,id',
        ];
    }

    public function fields(): array
    {
        $fields = $this->all() + [
                'is_special_access' => false,
            ];

        if (!empty($fields['scheduled_at'])) {
            $fields['scheduled_at'] = Carbon::createFromTimeString($fields['scheduled_at']);
        }

        if (empty($fields['slug'])) {
            $fields['slug'] = Str::slug($this->input('title'));
        }

        return $fields;
    }
}
