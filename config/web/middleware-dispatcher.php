<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiisoft\Csrf\CsrfMiddleware;
use Yiisoft\ErrorHandler\ErrorCatcher;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionMiddleware;

return [
    MiddlewareDispatcher::class => static function (ContainerInterface $container) {
        $middlewareFactory = $container->get(\Yiisoft\Middleware\Dispatcher\MiddlewareFactoryInterface::class);
        $middlewareStack = $container->get(\Yiisoft\Middleware\Dispatcher\MiddlewareStackInterface::class);

        return (new MiddlewareDispatcher($middlewareFactory, $middlewareStack))
             ->withMiddlewares([
                 Router::class,
                 SessionMiddleware::class,
                 CsrfMiddleware::class,
                 ErrorCatcher::class,
             ]);
    },
];
