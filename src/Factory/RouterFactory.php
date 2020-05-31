<?php

declare(strict_types=1);

namespace App\Factory;

use Psr\Container\ContainerInterface;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Router\FastRoute\UrlMatcher;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Yii\Web\Data\Middleware\FormatDataResponse;

class RouterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $routes = require Builder::path('routes');

        $collector = $container->get(RouteCollectorInterface::class);
        $collector->addGroup(
            Group::create(null, $routes)
                ->addMiddleware(FormatDataResponse::class)
        );

        return new UrlMatcher(new RouteCollection($collector));
    }
}
