<?php

declare(strict_types=1);

use Yiisoft\Csrf\CsrfMiddleware;
use Yiisoft\ErrorHandler\ErrorCatcher;
use Yiisoft\Injector\Injector;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionMiddleware;

return [    
    'application-dispatcher' => static function (Injector $injector) {
        $middlewareDispatcher = $injector->make(MiddlewareDispatcher::class);

        return $middlewareDispatcher->withMiddlewares([
            Router::class,
            SessionMiddleware::class,
            CsrfMiddleware::class,
            ErrorCatcher::class,
        ]);
    }
];
