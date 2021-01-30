<?php

declare(strict_types=1);

use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollectorInterface;

return [
    RouteCollectionInterface::class => static function (RouteCollectorInterface $collector) use ($config) {
        $collector->addGroup(
            Group::create(null, $config->get('routes'))
                ->addMiddleware(FormatDataResponse::class)
        );

        return new RouteCollection($collector);
    },
];
