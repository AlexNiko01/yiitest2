<?php
return [
    'admin' => [
        'type' => 1,
        'ruleName' => 'userRole',
        'children' => [
            'customer',
        ],
    ],
    'customer' => [
        'type' => 1,
        'ruleName' => 'userRole',
    ],
];
