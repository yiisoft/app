<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Router\FastRoute\UrlMatcher;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectorInterface;
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
     * @psalm-suppress InaccessibleMethod
     */
    public function register(Container $container): void
    {
        $container->set(UrlMatcherInterface::class, function (ContainerInterface $container) {
            $collector = $container->get(RouteCollectorInterface::class);
            $collector->addGroup(
                Group::create(null, $this->routes)
                    ->addMiddleware(FormatDataResponse::class)
            );

            return new UrlMatcher(new RouteCollection($collector));
        });
    }
}
