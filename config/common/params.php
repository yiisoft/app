<?php

declare(strict_types=1);

use App\ViewInjection\CommonViewInjection;
use App\ViewInjection\LayoutViewInjection;
use App\ViewInjection\TranslatorViewInjection;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Session\SessionMiddleware;
use Yiisoft\Yii\Middleware\Locale;
use Yiisoft\Yii\View\CsrfViewInjection;

return [
    'app' => [
        'charset' => 'UTF-8',
        'locale' => 'en',
        'name' => 'My Project',
    ],
    'locale' => [
        'locales' => ['en' => 'en-US', 'ru' => 'ru-RU'],
        'ignoredRequests' => [
            '/debug**',
        ],
    ],
    'middlewares' => [
        ErrorCatcher::class,
        SessionMiddleware::class,
        Locale::class,
        Router::class,
    ],

    'yiisoft/aliases' => [
        'aliases' => require __DIR__ . '/aliases.php',
    ],

    'yiisoft/translator' => [
        'locale' => 'en',
        'fallbackLocale' => 'en',
        'defaultCategory' => 'app',
    ],

    'yiisoft/yii-view' => [
        'injections' => [
            Reference::to(CommonViewInjection::class),
            Reference::to(CsrfViewInjection::class),
            Reference::to(LayoutViewInjection::class),
            Reference::to(TranslatorViewInjection::class),
        ],
    ],
];
