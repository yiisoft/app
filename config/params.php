<?php

declare(strict_types=1);

use Psr\Log\LogLevel;

return [
    'aliases' => [
        '@root' => dirname(__DIR__),
        '@assets' => '@root/public/assets',
        '@assetsUrl' => '/assets',
        '@npm' => '@root/node_modules',
        '@public' => '@root/public',
        '@resources' => '@root/resources',
        '@runtime' => '@root/runtime',
        '@views' => '@root/resources/views'
    ],

    'yiisoft/cache-file' => [
        'file-cache' => [
            'path' => '@runtime/cache'
        ],
    ],

    'yiisoft/log-target-file' => [
        'file-target' => [
            'file' => '@runtime/logs/app.log',
            'levels' => [
                LogLevel::EMERGENCY,
                LogLevel::ERROR,
                LogLevel::WARNING,
                LogLevel::INFO,
                LogLevel::DEBUG,
            ],
        ],
        'file-rotator' => [
            'maxfilesize' => 10,
            'maxfiles' => 5,
            'filemode' => null,
            'rotatebycopy' => null
        ],
    ],

    'yiisoft/view' => [
        'defaultParameters' => [
            'applicationParameters' => 'App\ApplicationParameters',
            'assetManager' => 'Yiisoft\Assets\AssetManager',
        ],
    ],

    'yiisoft/yii-web' => [
        'session' => [
            'options' => ['cookie_secure' => 0],
            'handler' => null
        ],
    ],

    'yiisoft/yii-debug' => [
        'enabled' => true
    ],

    'app' => [
        'charset' => 'UTF-8',
        'language' => 'en',
        'name' => 'My Project',
    ],
];
