<?php

declare(strict_types=1);

use App\Command\Hello;
use App\ApplicationParameters;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Yii\View\CsrfViewInjection;

return [
    'app' => [
        'charset' => 'UTF-8',
        'language' => 'en-US',
        'name' => 'My Project',
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__),
            '@assets' => '@root/public/assets',
            '@assetsUrl' => '/assets',
            '@npm' => '@root/node_modules',
            '@public' => '@root/public',
            '@resources' => '@root/resources',
            '@runtime' => '@root/runtime',
            '@views' => '@root/resources/views',
            '@message' => '@root/resources/message',
        ],
    ],

    'yiisoft/view' => [
        'basePath' => '@views',
        'defaultParameters' => [
            'applicationParameters' => Reference::to(ApplicationParameters::class),
            'assetManager' => Reference::to(AssetManager::class),
            'locale' => Reference::to(Locale::class),
            'url' => Reference::to(UrlGeneratorInterface::class),
            'urlMatcher' => Reference::to(UrlMatcherInterface::class),
        ],
    ],

    'yiisoft/yii-console' => [
        'commands' => [
            'hello' => Hello::class,
        ],
    ],

    'yiisoft/yii-debug' => [
        'enabled' => true,
    ],

    'yiisoft/yii-view' => [
        'viewBasePath' => '@views',
        'layout' => '@resources/layout/main',
        'injections' => [
            Reference::to(CsrfViewInjection::class),
        ],
    ],

    'yiisoft/router' => [
        'enableCache' => false,
    ],

    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
