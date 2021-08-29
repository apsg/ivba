<?php
namespace App\Domains\Logbooks\Requests\Admin;

class UpdateLogbookRequest extends StoreLogbookRequest
{
    public function rules()
    {
        return [
                'course_id'   => 'array',
                'course_id.*' => 'integer',
            ] + parent::rules();
    }
}
