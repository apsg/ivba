<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'introduction' => 'required',
            'price'     => 'required|numeric|min:0',
            'difficulty' => 'required|numeric|min:1|max:3',
            'image_id' => 'exists:images,id',
            // 'video_id' => 'exists:videos,id',
            'duration' => 'required|numeric|min:0',
            'slug' => 'unique:lessons,slug,'.( $this->route('lesson')->id ?? "") ,
        ];
    }
}
