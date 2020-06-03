<?php

declare(strict_types=1);

use App\Provider\CacheProvider;
use App\Provider\EventDispatcherProvider;
use App\Provider\LoggerProvider;
use App\Provider\MiddlewareProvider;
use App\Provider\RouterProvider;
use App\Provider\WebViewProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;

return [
    'yiisoft/router' => RouterProvider::class,
    'yiisoft/web' => MiddlewareProvider::class,
    'yiisoft/cache' => CacheProvider::class,
    'yiisoft/eventDispatcher' => EventDispatcherProvider::class,
    'yiisoft/logger' => LoggerProvider::class,
    'yiisoft/view' => WebViewProvider::class,

    ReverseBlockMerge::class => new ReverseBlockMerge()
];
