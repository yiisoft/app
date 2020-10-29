<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiisoft\Csrf\CsrfMiddleware;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionMiddleware;
use Yiisoft\Yii\Web\ErrorHandler\ErrorCatcher;
use Yiisoft\Yii\Web\MiddlewareDispatcher;

return [
    /** component middleware dispatcher */
    MiddlewareDispatcher::class => static fn (ContainerInterface $container) => (new MiddlewareDispatcher($container))
        ->addMiddleware($container->get(Router::class))
        ->addMiddleware($container->get(SessionMiddleware::class))
        ->addMiddleware($container->get(CsrfMiddleware::class))
        ->addMiddleware($container->get(ErrorCatcher::class)),
];
