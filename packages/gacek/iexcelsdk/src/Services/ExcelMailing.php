<?php
namespace Gacek\IExcel\Services;

use Gacek\IExcel\BaseIExcelService;

class ExcelMailing extends BaseIExcelService
{
    const ACTION_REGISTERED = 'registered';
    const ACTION_ACCESS = 'access';
    const ACTION_EXPIRED = 'expired';

    protected $url = 'http://excelmailing.pl/mailing.php';

    public function register(string $email = null)
    {
        return $this->send([
            'email'  => $email,
            'action' => static::ACTION_REGISTERED,
        ]);
    }

    public function access(string $email = null)
    {
        return $this->send([
            'email'  => $email,
            'action' => static::ACTION_ACCESS,
        ]);
    }

    public function expired(string $email = null)
    {
        return $this->send([
            'email'  => $email,
            'action' => static::ACTION_EXPIRED,
        ]);
    }
}