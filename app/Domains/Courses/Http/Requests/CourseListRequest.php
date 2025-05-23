<?php

namespace App\Domains\Courses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'group'     => 'sometimes|exists:groups,id',
            'search'    => 'sometimes|string|nullable',
            'sort'      => 'sometimes|in:new,cheapest,expensive,promotion,bestseller',
            'newsearch' => 'sometimes|boolean',
        ];
    }
}
