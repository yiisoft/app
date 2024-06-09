<?php

declare(strict_types=1);

use Yiisoft\Config\Config;
use Yiisoft\DataResponse\Middleware\FormatDataResponse;
use Yiisoft\Csrf\CsrfMiddleware;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollection;
use Yiisoft\Router\RouteCollectionInterface;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Yii\Debug\Viewer\Middleware\ToolbarMiddleware;

/** @var Config $config */

return [
    RouteCollectionInterface::class => static function (RouteCollectorInterface $collector) use ($config) {
        $collector
            ->middleware(CsrfMiddleware::class)
            ->middleware(FormatDataResponse::class)
            ->addGroup(
                Group::create()
                    ->routes(...$config->get('routes'))
            );


        if (!str_starts_with(getenv('YII_ENV') ?: '', 'prod')) {
            $collector->prependMiddleware(ToolbarMiddleware::class);
        }

        return new RouteCollection($collector);
    },
];
