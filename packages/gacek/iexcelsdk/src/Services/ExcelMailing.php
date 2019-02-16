<?php
namespace Gacek\IExcel\Services;

use Gacek\IExcel\BaseIExcelService;

class ExcelMailing extends BaseIExcelService
{
    const ACTION_REGISTERED = 'registered';
    const ACTION_ACCESS = 'access';
    const ACTION_EXPIRED = 'expired';

    protected $url = 'http://excelmailing.pl/mailing.php';

    public function register($email)
    {
        $res = $this->send([
            'email'  => $email,
            'action' => static::ACTION_REGISTERED,
        ]);

        return [
            'status' => $res->getStatusCode(),
            'body'   => $res->getBody()->getContents(),
        ];
    }

    public function access($email)
    {
        $res = $this->send([
            'email'  => $email,
            'action' => static::ACTION_ACCESS,
        ]);

        return [
            'status' => $res->getStatusCode(),
            'body'   => $res->getBody()->getContents(),
        ];
    }

    public function expired($email)
    {
        $res = $this->send([
            'email'  => $email,
            'action' => static::ACTION_EXPIRED,
        ]);

        return [
            'status' => $res->getStatusCode(),
            'body'   => $res->getBody()->getContents(),
        ];
    }
}