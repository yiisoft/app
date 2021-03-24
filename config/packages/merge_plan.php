<?php

declare(strict_types=1);

// Do not edit. Content will be replaced.
return [
    'common' => [
        '/' => [
            'config/common/*.php',
        ],
        'yiisoft/cache-file' => [
            'common.php',
        ],
        'yiisoft/log-target-file' => [
            'common.php',
        ],
        'yiisoft/yii-debug' => [
            'common.php',
        ],
        'yiisoft/cache' => [
            'common.php',
        ],
        'yiisoft/view' => [
            'common.php',
        ],
        'yiisoft/profiler' => [
            'common.php',
        ],
        'yiisoft/yii-filesystem' => [
            'common.php',
        ],
        'yiisoft/aliases' => [
            'common.php',
        ],
        'yiisoft/router' => [
            'common.php',
        ],
        'yiisoft/router-fastroute' => [
            'common.php',
        ],
        'yiisoft/yii-event' => [
            'common.php',
        ],
        'yiisoft/validator' => [
            'common.php',
        ],
    ],
    'console' => [
        '/' => [
            '$common',
            'config/console/*.php',
        ],
        'yiisoft/yii-debug' => [
            'console.php',
        ],
        'yiisoft/yii-console' => [
            'console.php',
        ],
        'yiisoft/yii-event' => [
            'console.php',
        ],
    ],
    'events' => [
        '/' => [
            'config/events.php',
        ],
        'yiisoft/yii-event' => [
            'events.php',
        ],
    ],
    'events-console' => [
        '/' => [
            '$events',
            'config/events-console.php',
        ],
        'yiisoft/yii-debug' => [
            'events-console.php',
        ],
        'yiisoft/yii-event' => [
            '$events',
            'events-console.php',
        ],
    ],
    'events-web' => [
        '/' => [
            '$events',
            'config/events-web.php',
        ],
        'yiisoft/yii-debug' => [
            'events-web.php',
        ],
        'yiisoft/log' => [
            'events-web.php',
        ],
        'yiisoft/profiler' => [
            'events-web.php',
        ],
        'yiisoft/yii-event' => [
            '$events',
            'events-web.php',
        ],
    ],
    'params' => [
        '/' => [
            'config/params.php',
            '?config/params-local.php',
        ],
        'yiisoft/cache-file' => [
            'params.php',
        ],
        'yiisoft/log-target-file' => [
            'params.php',
        ],
        'yiisoft/yii-bulma' => [
            'params.php',
        ],
        'yiisoft/yii-debug' => [
            'params.php',
        ],
        'yiisoft/yii-view' => [
            'params.php',
        ],
        'yiisoft/assets' => [
            'params.php',
        ],
        'yiisoft/csrf' => [
            'params.php',
        ],
        'yiisoft/session' => [
            'params.php',
        ],
        'yiisoft/view' => [
            'params.php',
        ],
        'yiisoft/profiler' => [
            'params.php',
        ],
        'yiisoft/yii-console' => [
            'params.php',
        ],
        'yiisoft/yii-web' => [
            'params.php',
        ],
        'yiisoft/aliases' => [
            'params.php',
        ],
        'yiisoft/router-fastroute' => [
            'params.php',
        ],
    ],
    'providers' => [
        '/' => [
            'config/providers.php',
        ],
        'yiisoft/yii-debug' => [
            'providers.php',
        ],
        'yiisoft/widget' => [
            'providers.php',
        ],
        'yiisoft/yii-filesystem' => [
            'providers.php',
        ],
    ],
    'providers-console' => [
        '/' => [
            '$providers',
            'config/providers-console.php',
        ],
        'yiisoft/yii-console' => [
            'providers-console.php',
        ],
    ],
    'providers-web' => [
        '/' => [
            '$providers',
            'config/providers-web.php',
        ],
    ],
    'routes' => [
        '/' => [
            'config/routes.php',
        ],
    ],
    'tests' => [
        'yiisoft/yii-debug' => [
            'tests.php',
        ],
        'yiisoft/yii-web' => [
            '$web',
        ],
    ],
    'web' => [
        '/' => [
            '$common',
            'config/web/*.php',
        ],
        'yiisoft/error-handler' => [
            'web.php',
        ],
        'yiisoft/yii-bulma' => [
            'web/*.php',
        ],
        'yiisoft/yii-debug' => [
            'web.php',
        ],
        'yiisoft/yii-view' => [
            'web.php',
        ],
        'yiisoft/assets' => [
            'web.php',
        ],
        'yiisoft/csrf' => [
            'web.php',
        ],
        'yiisoft/session' => [
            'web.php',
        ],
        'yiisoft/data-response' => [
            'web.php',
        ],
        'yiisoft/view' => [
            'web.php',
        ],
        'yiisoft/yii-web' => [
            'web.php',
        ],
        'yiisoft/middleware-dispatcher' => [
            'web.php',
        ],
        'yiisoft/router-fastroute' => [
            'web.php',
        ],
        'yiisoft/yii-event' => [
            'web.php',
        ],
    ],
];
