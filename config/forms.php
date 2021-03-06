<?php

use App\Domains\Forms\Models\Form;

return [
    'report'   => [
        'name'   => 'Raport z kampanii',
        'fields' => [
            'r1' => [
                'name' => 'Miejsce reklamowania się',
                'type' => Form::FIELD_TEXT,
            ],
            'r2' => [
                'name' => 'Nazwa produktu',
                'type' => Form::FIELD_TEXT,
            ],
            'r3' => [
                'name' => 'Wydany budżet',
                'type' => Form::FIELD_NUMBER,
            ],
            'r4' => [
                'name' => 'Średni CPM',
                'type' => Form::FIELD_NUMBER,
            ],
            'r5' => [
                'name' => 'Średni CPC',
                'type' => Form::FIELD_NUMBER,
            ],
            'r6' => [
                'name' => 'Koszt dodania do koszyka',
                'type' => Form::FIELD_NUMBER,
            ],
            'r7' => [
                'name' => 'Koszt dokonania sprzedaży',
                'type' => Form::FIELD_NUMBER,
            ],
            'r8' => [
                'name' => 'Link do produktu w sklepie',
                'type' => Form::FIELD_URL,
            ],
            'r9' => [
                'name' => 'Link do kampanii',
                'type' => Form::FIELD_URL,
            ],
        ],
    ],
    'products' => [
        'name'   => 'Wybór produktów',
        'fields' => [
            'p1' => [
                'name' => 'Nazwa produktu',
                'type' => Form::FIELD_TEXT,
            ],
            'p2' => [
                'name' => 'Link do produktu w sklepie',
                'type' => Form::FIELD_URL,
            ],
            'p3' => [
                'name' => 'Cena produktu',
                'type' => Form::FIELD_NUMBER,
            ],
            'p4' => [
                'name' => 'Cena sprzedaży',
                'type' => Form::FIELD_NUMBER,
            ],
        ],
    ],
    'weeks'    => [
        'name'   => 'Raport sprzedaży',
        'fields' => [
            'w1' => [
                'name' => 'Tydzień',
                'type' => Form::FIELD_WEEK,
            ],
            'w2' => [
                'name' => 'Wydatki na reklamę',
                'type' => Form::FIELD_NUMBER,
            ],
            'w3' => [
                'name' => 'Sprzedaż',
                'type' => Form::FIELD_NUMBER,
            ],
            'w4' => [
                'name' => 'Zysk',
                'type' => Form::FIELD_NUMBER,
            ],
        ],
    ],
    'reklama'  => [
        'name'   => 'Reklamy konkurencji',
        'fields' => [
            'rk1' => [
                'name' => 'Adres reklamy 1',
                'type' => Form::FIELD_URL,
            ],
            'rk2' => [
                'name' => 'Adres reklamy 2',
                'type' => Form::FIELD_URL,
            ],
            'rk3' => [
                'name' => 'Adres reklamy 3',
                'type' => Form::FIELD_URL,
            ],
            'rk4' => [
                'name' => 'Adres reklamy 4',
                'type' => Form::FIELD_URL,
            ],
            'rk5' => [
                'name' => 'Adres reklamy 5',
                'type' => Form::FIELD_URL,
            ],
        ],
    ],
    'sklepy'   => [
        'name'   => 'Szukanie konkurencyjnych sklepów',
        'fields' => [
            'sk1' => [
                'name' => 'Adres sklepu 1',
                'type' => Form::FIELD_URL,
            ],
            'sk2' => [
                'name' => 'Adres sklepu 2',
                'type' => Form::FIELD_URL,
            ],
            'sk3' => [
                'name' => 'Adres sklepu 3',
                'type' => Form::FIELD_URL,
            ],
            'sk4' => [
                'name' => 'Adres sklepu 4',
                'type' => Form::FIELD_URL,
            ],
            'sk5' => [
                'name' => 'Adres sklepu 5',
                'type' => Form::FIELD_URL,
            ],
        ],
    ],
    'adres'    => [
        'name'   => 'Podaj adres Twojego sklepu Internetowego',
        'fields' => [
            'ad1' => [
                'name' => 'Adres WWW',
                'type' => Form::FIELD_URL,
            ],
        ],
    ],
    'produkt'  => [
        'name'   => 'Podaj bezpośredni link do produktu, który chcesz sprzedawać.',
        'fields' => [
            'pb1' => [
                'name' => 'Adres WWW',
                'type' => Form::FIELD_URL,
            ],
        ],
    ],
];
