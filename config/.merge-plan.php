<?php

declare(strict_types=1);

// Do not edit. Content will be replaced.
return [
    '/' => [
        'di' => [
            'yiisoft/cache-file' => [
                'config/di.php',
            ],
            'yiisoft/router-fastroute' => [
                'config/di.php',
            ],
            'yiisoft/aliases' => [
                'config/di.php',
            ],
            'yiisoft/cache' => [
                'config/di.php',
            ],
            'yiisoft/log-target-file' => [
                'config/di.php',
            ],
            'yiisoft/router' => [
                'config/di.php',
            ],
            'yiisoft/view' => [
                'config/di.php',
            ],
            'yiisoft/yii-debug' => [
                'config/di.php',
            ],
            'yiisoft/profiler' => [
                'config/di.php',
            ],
            'yiisoft/validator' => [
                'config/di.php',
            ],
            'yiisoft/yii-queue' => [
                'config/di.php',
            ],
            'yiisoft/translator' => [
                'config/di.php',
            ],
            'yiisoft/yii-event' => [
                'config/di.php',
            ],
            '/' => [
                '$common',
                'common/di/*.php',
            ],
        ],
        'params' => [
            'yiisoft/cache-file' => [
                'config/params.php',
            ],
            'yiisoft/router-fastroute' => [
                'config/params.php',
            ],
            'yiisoft/yii-view' => [
                'config/params.php',
            ],
            'yiisoft/yii-debug-api' => [
                'config/params.php',
            ],
            'yiisoft/yii-debug-viewer' => [
                'config/params.php',
            ],
            'yiisoft/aliases' => [
                'config/params.php',
            ],
            'yiisoft/assets' => [
                'config/params.php',
            ],
            'yiisoft/csrf' => [
                'config/params.php',
            ],
            'yiisoft/session' => [
                'config/params.php',
            ],
            'yiisoft/data-response' => [
                'config/params.php',
            ],
            'yiisoft/log-target-file' => [
                'config/params.php',
            ],
            'yiisoft/view' => [
                'config/params.php',
            ],
            'yiisoft/yii-debug' => [
                'config/params.php',
            ],
            'yiisoft/profiler' => [
                'config/params.php',
            ],
            'yiisoft/validator' => [
                'config/params.php',
            ],
            'yiisoft/yii-queue' => [
                'config/params.php',
            ],
            'yiisoft/translator' => [
                'config/params.php',
            ],
            'yiisoft/yii-console' => [
                'config/params.php',
            ],
            '/' => [
                'common/params.php',
            ],
        ],
        'di-web' => [
            'yiisoft/router-fastroute' => [
                'config/di-web.php',
            ],
            'yiisoft/yii-view' => [
                'config/di-web.php',
            ],
            'yiisoft/yii-debug-api' => [
                'config/di-web.php',
            ],
            'yiisoft/yii-debug-viewer' => [
                'config/di-web.php',
            ],
            'yiisoft/assets' => [
                'config/di-web.php',
            ],
            'yiisoft/csrf' => [
                'config/di-web.php',
            ],
            'yiisoft/session' => [
                'config/di-web.php',
            ],
            'yiisoft/data-response' => [
                'config/di-web.php',
            ],
            'yiisoft/error-handler' => [
                'config/di-web.php',
            ],
            'yiisoft/view' => [
                'config/di-web.php',
            ],
            'yiisoft/yii-debug' => [
                'config/di-web.php',
            ],
            'yiisoft/yii-event' => [
                'config/di-web.php',
            ],
            '/' => [
                '$di',
                '$web',
                'web/di/*.php',
            ],
        ],
        'bootstrap-web' => [
            'yiisoft/yii-debug-api' => [
                'config/bootstrap-web.php',
            ],
            '/' => [
                '$bootstrap',
            ],
        ],
        'routes' => [
            'yiisoft/yii-debug-api' => [
                'config/routes.php',
            ],
            'yiisoft/yii-debug-viewer' => [
                'config/routes.php',
            ],
            '/' => [
                'common/routes.php',
            ],
        ],
        'di-providers-web' => [
            'yiisoft/yii-debug-api' => [
                'config/di-providers-web.php',
            ],
        ],
        'events-console' => [
            'yiisoft/log' => [
                'config/events-console.php',
            ],
            'yiisoft/yii-debug' => [
                'config/events-console.php',
            ],
            'yiisoft/yii-console' => [
                'config/events-console.php',
            ],
            '/' => [
                '$events',
            ],
        ],
        'events-web' => [
            'yiisoft/log' => [
                'config/events-web.php',
            ],
            'yiisoft/yii-debug' => [
                'config/events-web.php',
            ],
            'yiisoft/profiler' => [
                'config/events-web.php',
            ],
            '/' => [
                '$events',
            ],
        ],
        'di-console' => [
            'yiisoft/yii-debug' => [
                'config/di-console.php',
            ],
            'yiisoft/yii-console' => [
                'config/di-console.php',
            ],
            'yiisoft/yii-event' => [
                'config/di-console.php',
            ],
            '/' => [
                '$di',
                '$console',
            ],
        ],
        'di-providers' => [
            'yiisoft/yii-debug' => [
                'config/di-providers.php',
            ],
        ],
        'params-web' => [
            '/' => [
                '$params',
                'web/params.php',
            ],
        ],
        'params-console' => [
            '/' => [
                '$params',
                'console/params.php',
            ],
        ],
        'events' => [
            '/' => [],
        ],
        'bootstrap' => [
            '/' => [],
        ],
        'bootstrap-console' => [
            '/' => [
                '$bootstrap',
            ],
        ],
    ],
    'dev' => [
        'params' => [
            '/' => [
                'environments/dev/params.php',
            ],
        ],
    ],
    'prod' => [
        'params' => [
            '/' => [
                'environments/prod/params.php',
            ],
        ],
    ],
    'test' => [
        'params' => [
            '/' => [
                'environments/test/params.php',
            ],
        ],
    ],
];
