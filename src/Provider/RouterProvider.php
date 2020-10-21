<?php

declare(strict_types=1);

namespace App\Provider;

use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;

final class RouterProvider extends ServiceProvider
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @psalm-suppress InaccessibleMethod
     */
    public function register(Container $container): void
    {
        $container->set(RouteCollectionInterface::class, function (RouteCollectorInterface $collector) {
            $collector->addGroup(
                Group::create(null, $this->routes)->addMiddleware(FormatDataResponse::class)
            );

            return new RouteCollection($collector);
        });
    }
}
