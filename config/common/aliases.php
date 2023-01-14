<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;

/** @var array $params */

return [
    Aliases::class => [
        '__construct()' => [
            array_merge($params['yiisoft/aliases']['aliases'], ['@baseUrl' => $params['app']['prefix']]),
        ],
    ],
];
