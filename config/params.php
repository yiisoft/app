<?php

declare(strict_types=1);

use App\Command\Hello;
use App\ViewInjection\ContentViewInjection;
use App\ViewInjection\LayoutViewInjection;
use Yiisoft\Arrays\Collection\ArrayCollection;
use Yiisoft\Arrays\Collection\Modifier\SaveOrder;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Yii\View\CsrfViewInjection;

return new ArrayCollection(
    [
        'app' => [
            'charset' => 'UTF-8',
            'locale' => 'en',
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
                Reference::to(ContentViewInjection::class),
                Reference::to(CsrfViewInjection::class),
                Reference::to(LayoutViewInjection::class),
            ],
        ],

        'yiisoft/router' => [
            'enableCache' => false,
        ],
    ],
    new SaveOrder()
);
