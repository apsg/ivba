<?php
namespace App\Helpers;

use Carbon\Carbon;
use PayPal;

class PayPalHelper
{
    public static function getNextDate($profileid)
    {

        $provider = PayPal::setProvider('express_checkout');
        $details = $provider->getRecurringPaymentsProfileDetails($profileid);

        if (isset($details['STATUS'])) {
            if ($details['STATUS'] == 'Active') {
                return Carbon::parse($details['NEXTBILLINGDATE']);
            }

            if ($details['STATUS'] == 'Cancelled') {
                return false;
            }

            return $details;
        }

        return false;
    }

    /**
     * Pobiera status subskrypcji
     * @param  [type] $profileid [description]
     * @return [type]            [description]
     */
    public static function getStatus($profileid)
    {
        $provider = PayPal::setProvider('express_checkout');
        $details = $provider->getRecurringPaymentsProfileDetails($profileid);

        if (isset($details['STATUS'])) {
            return $details['STATUS'];
        }

        return false;
    }

    /**
     * Anuluj subskrypcję
     * @param  [type] $profileid [description]
     * @return [type]            [description]
     */
    public static function cancel($profileid)
    {
        $provider = PayPal::setProvider('express_checkout');

        return $provider->cancelRecurringPaymentsProfile($profileid);
    }
}