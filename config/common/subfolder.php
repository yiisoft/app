<?php

declare(strict_types=1);

use Yiisoft\Yii\Middleware\SubFolder;

/** @var array $params */

return [
    SubFolder::class => [
        '__construct()' => [
            'prefix' => $params['app']['prefix'] === '/' ? null : $params['app']['prefix'],
        ],
    ],
];
