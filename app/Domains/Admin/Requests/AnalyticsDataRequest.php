<?php
namespace App\Domains\Admin\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AnalyticsDataRequest extends FormRequest
{
    public function rules()
    {
        return [
            'start' => 'required|numeric',
            'end'   => 'required|numeric|gte:start',
        ];
    }

    public function start() : Carbon
    {
        if ($this->input('start') === null) {
            return Carbon::now()->startOfMonth();
        }

        return Carbon::createFromTimestamp($this->input('start'))
            ->startOfDay();
    }

    public function end() : Carbon
    {
        if ($this->input('end') === null) {
            return Carbon::now()->endOfDay();
        }

        return Carbon::createFromTimestamp($this->input('end'))->endOfDay();
    }
}
