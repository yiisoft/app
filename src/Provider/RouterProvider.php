<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Router\Dispatcher;
use Yiisoft\Router\DispatcherInterface;
use Yiisoft\Router\FastRoute\UrlGenerator;
use Yiisoft\Router\FastRoute\UrlMatcher;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;

final class RouterProvider extends ServiceProvider
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(DispatcherInterface::class, Dispatcher::class);

        $container->set(RouteCollectorInterface::class, Group::create());

        $container->set(UrlMatcherInterface::class, function (ContainerInterface $container) {
            $collector = $container->get(RouteCollectorInterface::class);
            $collector->addGroup(
                Group::create(null, $this->routes)
                    ->addMiddleware(FormatDataResponse::class)
            );

            return new UrlMatcher(new RouteCollection($collector));
        });

        $container->set(UrlGeneratorInterface::class, UrlGenerator::class);
    }
}
