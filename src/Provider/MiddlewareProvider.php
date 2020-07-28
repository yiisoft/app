<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Yii\Web\MiddlewareDispatcher;
use Yiisoft\Yii\Web\ErrorHandler\ErrorCatcher;
use Yiisoft\Yii\Web\Middleware\Csrf;
use Yiisoft\Yii\Web\Middleware\SubFolder;
use Yiisoft\Yii\Web\Session\SessionMiddleware;

final class MiddlewareProvider extends ServiceProvider
{
    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(MiddlewareDispatcher::class, static function (ContainerInterface $container) {
            return (new MiddlewareDispatcher($container))
                ->addMiddleware($container->get(Router::class))
                ->addMiddleware($container->get(SubFolder::class))
                ->addMiddleware($container->get(SessionMiddleware::class))
                ->addMiddleware($container->get(Csrf::class))
                ->addMiddleware($container->get(ErrorCatcher::class));
        });
    }
}
