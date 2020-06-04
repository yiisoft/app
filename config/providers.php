<?php

declare(strict_types=1);

use App\Provider\CacheProvider;
use App\Provider\EventDispatcherProvider;
use App\Provider\LoggerProvider;
use App\Provider\MiddlewareProvider;
use App\Provider\Psr17Provider;
use App\Provider\RouterProvider;
use App\Provider\SessionProvider;
use App\Provider\WebViewProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;

return [
    'yiisoft/app/router' => RouterProvider::class,
    'yiisoft/app/psr17' => Psr17Provider::class,
    'yiisoft/app/middleware' => MiddlewareProvider::class,
    'yiisoft/app/cache' => CacheProvider::class,
    'yiisoft/app/eventdispatcher' => EventDispatcherProvider::class,
    'yiisoft/app/logger' => LoggerProvider::class,
    'yiisoft/app/session' => SessionProvider::class,
    'yiisoft/app/webview' => WebViewProvider::class,

    ReverseBlockMerge::class => new ReverseBlockMerge()
];
