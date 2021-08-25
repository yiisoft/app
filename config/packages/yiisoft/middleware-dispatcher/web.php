<?php

declare(strict_types=1);

use Yiisoft\Middleware\Dispatcher\MiddlewareFactory;
use Yiisoft\Middleware\Dispatcher\MiddlewareFactoryInterface;

return [
    MiddlewareFactoryInterface::class => MiddlewareFactory::class,
];
