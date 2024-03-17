<?php
namespace App\Domains\Api\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class GrantAccessRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'          => 'required|email',
            'course_id'      => 'required_without:is_full_access|integer|exists:courses,id',
            'is_full_access' => 'required_without:course_id|boolean',
            'is_lifetime_access' => 'sometimes|nullable|boolean',
        ];
    }

    public function course(): ?Course
    {
        return Course::find($this->input('course_id'));
    }

    public function isFullAccess(): bool
    {
        if (empty($this->input('is_full_access'))) {
            return false;
        }

        return $this->input('is_full_access');
    }

    public function isLifetimeAccess(): bool
    {
        if (empty($this->input('is_lifetime_access'))) {
            return false;
        }

        return $this->input('is_lifetime_access');
    }
}
