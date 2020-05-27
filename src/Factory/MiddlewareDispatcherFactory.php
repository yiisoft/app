<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Web\ErrorHandler\ErrorCatcher;
use Yiisoft\Yii\Web\Middleware\Csrf;
use Yiisoft\Yii\Web\Middleware\SubFolder;
use Yiisoft\Yii\Web\MiddlewareDispatcher;
use Yiisoft\Yii\Web\Session\SessionMiddleware;

final class MiddlewareDispatcherFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $csrf = $container->get(Csrf::class);
        $session = $container->get(SessionMiddleware::class);
        $router = $container->get(Router::class);
        $errorCatcher = $container->get(ErrorCatcher::class);
        $subFolder = $container->get(SubFolder::class);

        return (new MiddlewareDispatcher($container))
            ->addMiddleware($router)
            ->addMiddleware($subFolder)
            ->addMiddleware($session)
            ->addMiddleware($csrf)
            ->addMiddleware($errorCatcher);
    }
}
