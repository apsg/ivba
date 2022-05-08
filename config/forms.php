<?php

return [
    'report'   => [
        'name'   => 'Raport z kampanii',
        'fields' => [
            'r1' => [
                'name' => 'Miejsce reklamowania się',
                'type' => 'text',
            ],
            'r2' => [
                'name' => 'Nazwa produktu',
                'type' => 'text',
            ],
            'r3' => [
                'name' => 'Wydany budżet',
                'type' => 'number',
            ],
            'r4' => [
                'name' => 'Średni CPM',
                'type' => 'number',
            ],
            'r5' => [
                'name' => 'Średni CPC',
                'type' => 'number',
            ],
            'r6' => [
                'name' => 'Koszt dodania do koszyka',
                'type' => 'number',
            ],
            'r7' => [
                'name' => 'Koszt dokonania sprzedaży',
                'type' => 'number',
            ],
            'r8' => [
                'name' => 'Link do produktu w sklepie',
                'type' => 'url',
            ],
            'r9' => [
                'name' => 'Link do kampanii',
                'type' => 'url',
            ],
        ],
    ],
    'products' => [
        'name'   => 'Wybór produktów',
        'fields' => [
            'p1' => [
                'name' => 'Nazwa produktu',
                'type' => 'text',
            ],
            'p2' => [
                'name' => 'Link do produktu w sklepie',
                'type' => 'url',
            ],
            'p3' => [
                'name' => 'Cena produktu',
                'type' => 'number',
            ],
            'p4' => [
                'name' => 'Cena sprzedaży',
                'type' => 'number',
            ],
        ],
    ],
];
