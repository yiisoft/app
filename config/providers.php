<?php

declare(strict_types=1);

/* @var array $params */

use App\Provider\LoggerProvider;
use App\Provider\RouterProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;

return [
    'yiisoft/router-fastroute/router' => [
        '__class' => RouterProvider::class,
        '__construct()' => [require __DIR__ . '/routes.php'],
    ],

    'LoggerProvider' => LoggerProvider::class,

    ReverseBlockMerge::class => Buildtime::run(new ReverseBlockMerge()),
];
