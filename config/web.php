<?php

declare(strict_types=1);

use App\LayoutParameters;
use App\Factory\MiddlewareDispatcherFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Yiisoft\Yii\Web\Data\DataResponseFactory;
use Yiisoft\Yii\Web\Data\DataResponseFactoryInterface;
use Yiisoft\Yii\Web\Data\DataResponseFormatterInterface;
use Yiisoft\Yii\Web\Data\Formatter\HtmlDataResponseFormatter;
use Yiisoft\Yii\Web\MiddlewareDispatcher;
use Yiisoft\Yii\Web\Session\Session;
use Yiisoft\Yii\Web\Session\SessionInterface;

return [
    RequestFactoryInterface::class => Psr17Factory::class,
    ServerRequestFactoryInterface::class => Psr17Factory::class,
    ResponseFactoryInterface::class => Psr17Factory::class,
    StreamFactoryInterface::class => Psr17Factory::class,
    UriFactoryInterface::class => Psr17Factory::class,
    UploadedFileFactoryInterface::class => Psr17Factory::class,
    DataResponseFormatterInterface::class => HtmlDataResponseFormatter::class,
    DataResponseFactoryInterface::class => DataResponseFactory::class,

    MiddlewareDispatcher::class => new MiddlewareDispatcherFactory(),

    SessionInterface::class => [
        '__class' => Session::class,
        '__construct()' => [
            $params['yiisoft/app']['session']['options'] ?? [],
            $params['yiisoft/app']['session']['handler'] ?? null,
        ],
    ],

    LayoutParameters::class => static function () use ($params) {
        $layoutParameters = new LayoutParameters();

        return $layoutParameters
            ->brandUrl($params['yiisoft/app']['brandurl'])
            ->charset($params['yiisoft/app']['charset'])
            ->heroOptions($params['yiisoft/app']['hero.options'])
            ->heroHeadOptions($params['yiisoft/app']['hero.head.options'])
            ->heroBodyOptions($params['yiisoft/app']['hero.body.options'])
            ->heroContainerOptions($params['yiisoft/app']['hero.container.options'])
            ->heroFooterOptions($params['yiisoft/app']['hero.footer.options'])
            ->heroFooterColumnOptions($params['yiisoft/app']['hero.footer.column.options'])
            ->heroFooterColumnLeft($params['yiisoft/app']['hero.footer.column.left'])
            ->heroFooterColumnLeftOptions($params['yiisoft/app']['hero.footer.column.left.options'])
            ->heroFooterColumnCenter($params['yiisoft/app']['hero.footer.column.center'])
            ->heroFooterColumnCenterOptions($params['yiisoft/app']['hero.footer.column.center.options'])
            ->heroFooterColumnRigth($params['yiisoft/app']['hero.footer.column.rigth'])
            ->heroFooterColumnRigthOptions($params['yiisoft/app']['hero.footer.column.rigth.options'])
            ->language($params['yiisoft/app']['language'])
            ->logo($params['yiisoft/app']['logo'])
            ->name($params['yiisoft/app']['name'])
            ->navBarOptions($params['yiisoft/app']['navbar.options'])
            ->navBarBrandOptions($params['yiisoft/app']['navbar.brand.options'])
            ->navBarBrandLogoOptions($params['yiisoft/app']['navbar.brand.logo.options'])
            ->navBarBrandTitleOptions($params['yiisoft/app']['navbar.brand.title.options'])
            ->loggerLevels($params['yiisoft/app']['logger']['levels']);
    },
];
