<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Router\FastRoute\UrlGenerator;
use Yiisoft\Router\FastRoute\UrlMatcher;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Yii\Web\Data\Middleware\FormatDataResponse;

final class RouterProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->set(RouteCollectorInterface::class, Group::create());

        $container->set(UrlMatcherInterface::class, static function (ContainerInterface $container) {
            $routes = require Builder::path('routes');

            $collector = $container->get(RouteCollectorInterface::class);
            $collector->addGroup(
                Group::create(null, $routes)
                    ->addMiddleware(FormatDataResponse::class)
            );

            return new UrlMatcher(new RouteCollection($collector));
        });

        $container->set(UrlGeneratorInterface::class, UrlGenerator::class);
    }
}
