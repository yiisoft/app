<?php

declare(strict_types=1);

/* @var array $params */

use App\Provider\LoggerProvider;
use App\Provider\RouterProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use Yiisoft\Composer\Config\Buildtime;

return [
    'yiisoft/router-fastroute/router' => [
        '__class' => RouterProvider::class,
        '__construct()' => [require 'routes.php'],
    ],

    'LoggerProvider' => LoggerProvider::class,

    ReverseBlockMerge::class => Buildtime::run(new ReverseBlockMerge()),
];
