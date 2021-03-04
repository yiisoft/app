<?php

declare(strict_types=1);

return [
    'yiisoft/assets' => [
        'assetConverter' => [
            'command' => [
                'from' => 'scss',
                'to' => 'css',
                'command' => '@npm/.bin/sass {options} {from} {to}',
            ],
            'forceConvert' => false,
        ],
        'assetPublisher' => [
            'appendTimestamp' => false,
            'assetMap' => [],
            'basePath' => null,
            'baseUrl' => null,
            'forceCopy' => false,
            'linkAssets' => false,
        ],
        'assetManager' => [
            'bundles' => [],
            'register' => [],
        ],
    ],
];
