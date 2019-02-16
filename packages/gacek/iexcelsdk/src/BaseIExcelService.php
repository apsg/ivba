<?php
namespace Gacek\IExcel;

abstract class BaseIExcelService
{
    /** @var string */
    protected $token;

    public function __construct(string $token = null)
    {
        $this->token = $token;
    }
}