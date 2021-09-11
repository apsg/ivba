<?php
namespace App\Domains\Logbooks\Requests;

use App\Helpers\GateHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StoreLogbookEntryRequest extends FormRequest
{
    public function authorize() : bool
    {
        if (Auth::guest()) {
            return false;
        }

        return Gate::allows(GateHelper::ACCESS_COURSE, $this->route('course'));
    }

    public function rules() : array
    {
        return [
            'title'       => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'image'       => 'sometimes|nullable|file|mimes:jpg,jpeg,png,bmp,webp|max:1024',
        ];
    }

    public function messages() : array
    {
        return [
            'title'       => 'Podaj tytuł',
            'description' => 'Dodaj opis (min. 3 znaki)',
            'image'       => 'Plik musi być obrazem i nie może być większy niż 1 MB',
        ];
    }

    public function attributes() : array
    {
        return [
            'title'       => 'tytuł',
            'description' => 'opis',
            'image'       => 'załącznik',
        ];
    }

    public function storeImage() : string
    {
        try {
            return $this->file('image')->store('public/logbooks');
        } catch (\Exception $exception) {
            return '';
        }
    }

    public function data() : array
    {
        return $this->only(['title', 'description'])
            + [
                'image' => $this->storeImage(),
            ];
    }
}
