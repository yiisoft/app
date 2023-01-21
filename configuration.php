<?php

declare(strict_types=1);

return [
    'config-plugin' => [
        'params' => [
            'common/params.php',
        ],
        'params-web' => [
            '$params',
        ],
        'params-console' => [
            '$params',
            'console/params.php',
        ],
        'di' => [
            '$common',
            'common/di/*.php',
        ],
        'di-web' => [
            '$di',
            '$web',
            'web/di/*.php',
        ],
        'di-console' => [
            '$di',
            '$console',
        ],
        'events' => [],
        'events-web' => [
            '$events',
        ],
        'events-console' => [
            '$events',
        ],
        'routes' => 'web/routes.php',
        'bootstrap' => [],
        'bootstrap-web' => [
            '$bootstrap',
        ],
        'bootstrap-console' => [
            '$bootstrap',
        ],
    ],
    'config-plugin-environments' => [
        'dev' => [
            'params' => [
                'environments/dev/params.php',
            ],
        ],
        'prod' => [
            'params' => [
                'environments/prod/params.php',
            ],
        ],
        'test' => [
            'params' => [
                'environments/test/params.php',
            ],
        ],
    ],
    'config-plugin-options' => [
        'source-directory' => 'config',
    ],
];
