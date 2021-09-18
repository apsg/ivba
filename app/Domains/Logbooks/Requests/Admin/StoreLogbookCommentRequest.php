<?php
namespace App\Domains\Logbooks\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogbookCommentRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'entry_id' => 'required|integer|exists:logbook_entries,id',
            'comment'  => 'required|string',
        ];
    }
}
