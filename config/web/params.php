<?php

declare(strict_types=1);

use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionMiddleware;

return [
    'middlewares' => [
        ErrorCatcher::class,
        SessionMiddleware::class,
        Router::class,
    ],

    'locale' => [
        'locales' => ['en' => 'en-US', 'ru' => 'ru-RU', 'de' => 'de-DE'],
        'ignoredRequests' => [
            '/gii**',
            '/debug**',
            '/inspect**',
        ],
    ],
];
