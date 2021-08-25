<?php

declare(strict_types=1);

use Yiisoft\Router\RouteCollector;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\CurrentRoute;

return [
    RouteCollectorInterface::class => RouteCollector::class,
    CurrentRoute::class => CurrentRoute::class,
];
