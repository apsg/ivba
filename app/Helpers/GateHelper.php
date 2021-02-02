<?php
namespace App\Helpers;

abstract class GateHelper
{
    const ADMIN = 'admin';

    /**
     * Access.
     */
    const ACCESS_COURSE = 'access-course';
    const ACCESS_LESSON = 'access-lesson';

    /**
     * Views - for special courses and systematic access
     */
    const VIEW_LESSON = 'view-lesson';

    /**
     * Actions.
     */
    const RETAKE_QUIZ = 'retake-quiz';
    const REQUEST_INVOICE = 'request-invoice';
    const CAN_BUY_SUBSCRIPTION = 'can-buy-subscription';
    const ACTIVE = 'active';
}
