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
];
