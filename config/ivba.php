<?php

return [

    /**
     * Na jaki email mają się wysyłać formularze kontaktowe
     */
    'contact_form_recipient' => env('FORM_EMAIL', 'info@iexcel.pl'),


    'full_access_price'    => 199,

    /** Duration in months */
    'full_access_duration' => 12,

    'full_access_description' => 'Pełen roczny dostęp do wszystkich materiałów',


//    'subscription_price_first'    => 1,

    /** Duration in days */
//    'subscription_duration_first' => 1,

//    'subscription_description_first' => 'Pierwsza płatność w abonamencie',


    'subscription_price'    => 19,

    /** Duration in months */
    'subscription_duration' => 1,

    'subscription_description' => 'Abonament miesięczny inauka.pl',

];