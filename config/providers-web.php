<?php

declare(strict_types=1);

use App\Provider\CacheProvider;
use App\Provider\EventDispatcherProvider;
use App\Provider\LoggerProvider;
use App\Provider\WebViewProvider;

return [
    'yiisoft/cache' => CacheProvider::class,
    'yiisoft/eventDispatcher' => EventDispatcherProvider::class,
    'yiisoft/logger' => LoggerProvider::class,
    'yiisoft/view' => WebViewProvider::class
];
