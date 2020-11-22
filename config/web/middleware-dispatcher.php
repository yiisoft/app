<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiisoft\Csrf\CsrfMiddleware;
use Yiisoft\ErrorHandler\ErrorCatcher;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionMiddleware;

return [
    MiddlewareDispatcher::class => static fn (ContainerInterface $container) => $container->get(MiddlewareDispatcher::class)
         ->withMiddlewares([
             Router::class,
             SessionMiddleware::class,
             CsrfMiddleware::class,
             ErrorCatcher::class,
         ])
];
