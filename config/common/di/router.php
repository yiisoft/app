<?php

declare(strict_types=1);

use Yiisoft\Config\Config;
use Yiisoft\Csrf\CsrfTokenMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollectorInterface;

/** @var Config $config */

return [
    RouteCollectionInterface::class => static function (RouteCollectorInterface $collector) use ($config) {
        $collector
            ->middleware(CsrfTokenMiddleware::class)
            ->middleware(FormatDataResponse::class)
            ->addRoute(...$config->get('routes'));

        return new RouteCollection($collector);
    },
];
