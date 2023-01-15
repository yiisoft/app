<?php

declare(strict_types=1);

return [
    'config-plugin-options' => [
        'source-directory' => 'config'
    ],
    'config-plugin-environments' => [
        'dev' => [
            'params' => [
                'environments/dev/params.php'
            ]
        ],
        'prod' => [
            'params' => [
                'environments/prod/params.php'
            ]
        ],
        'test' => [
            'params' => [
                'environments/test/params.php'
            ]
        ]
    ],
    'config-plugin' => [
        'common' => 'common/container/*.php',
        'params' => [
            'common/params.php'
        ],
        'params-web' => [
            '$params',
            'web/params.php',
        ],
        'params-console' => [
            '$params',
            'console/params.php'
        ],
        'container-web' => [
            '$common',
            '$web',
            'web/container/*.php'
        ],
        'container-console' => [
            '$common',
            '$console',
            'console/container/*.php'
        ],
        'events' => 'common/events.php',
        'events-web' => [
            '$events',
            'web/events.php'
        ],
        'events-console' => [
            '$events',
            'console/events.php'
        ],
        'routes' => 'web/routes.php',
        'bootstrap' => 'common/bootstrap.php',
        'bootstrap-web' => [
            '$bootstrap',
            'web/bootstrap.php'
        ],
        'bootstrap-console' => [
            '$bootstrap',
            'console/bootstrap.php'
        ],
        'widgets' => 'web/widgets.php'
    ]
];
