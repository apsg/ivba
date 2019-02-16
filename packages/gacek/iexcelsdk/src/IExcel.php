<?php
namespace Gacek\IExcel;

use Gacek\IExcel\Services\ExcelMailing;

class IExcel
{
    protected $token;

    public function __construct()
    {
        $this->token = config('iexcel.token');
    }

    public function excelmailing() : ExcelMailing
    {
        return new ExcelMailing($this->token);
    }
}