<?php
namespace Gacek\IExcel;

use Gacek\IExcel\Services\ExcelMailing;

class IExcel
{
    const INAUKA = 'inauka';
    const IEXCEL = 'iexcel';

    /** @var string */
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