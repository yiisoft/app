<?php

declare(strict_types=1);

/* @var array $params */

use App\Provider\CacheProvider;
use App\Provider\LoggerProvider;
use App\Provider\RouterProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use Yiisoft\Composer\Config\Builder;

return [
    'yiisoft/router-fastroute/router' => [
        '__class' => RouterProvider::class,
        '__construct()' => [Builder::require('routes')],
    ],
    'yiisoft/cache/cache' =>  [
        '__class' => CacheProvider::class,
        '__construct()' => [
            $params['yiisoft/cache-file']['file-cache']['path'],
        ],
    ],
    'yiisoft/log/logger' =>  LoggerProvider::class,

    ReverseBlockMerge::class => new ReverseBlockMerge()
];
