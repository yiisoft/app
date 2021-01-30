<?php

declare(strict_types=1);
return [
    'yiisoft/error-handler' => [
        'htmlRenderer' => [
            'templates' => [
                'default' => [
                    'callStackItem',
                    'error',
                    'exception',
                    'previousException',
                ],
            ],
        ],
        'exceptionResponder' => [
            'exceptionMap' => [],
        ],
    ],
];
