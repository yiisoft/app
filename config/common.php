<?php

declare(strict_types=1);

use App\LayoutParameters;
use App\Factory\RouterFactory;
use Psr\Container\ContainerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Router\FastRoute\UrlGenerator;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;

return [
    ContainerInterface::class => static function (ContainerInterface $container) {
        return $container;
    },

    /** ALIASES */
    Aliases::class => [
        '@app' => dirname(__DIR__),
        '@layout' => '@app/resources/layout',
        '@public' => '@app/public',
        '@npm' => '@app/node_modules',
        '@resources' => '@app/resources',
        '@src' => '@app/src',
        '@views' => '@app/resources/views',
        '@basePath' => '@public/assets',
        '@images' => '@public/images',
        '@web' => '/assets'
    ],

    /** LAYOUTPARAMETERS */
    LayoutParameters::class => static function () use ($params) {
        $layoutParameters = new LayoutParameters();

        return $layoutParameters
            ->brandUrl($params['yiisoft/app']['app']['brandurl'])
            ->charset($params['yiisoft/app']['app']['charset'])
            ->heroOptions($params['yiisoft/app']['app']['hero.options'])
            ->heroHeadOptions($params['yiisoft/app']['app']['hero.head.options'])
            ->heroBodyOptions($params['yiisoft/app']['app']['hero.body.options'])
            ->heroContainerOptions($params['yiisoft/app']['app']['hero.container.options'])
            ->heroFooterOptions($params['yiisoft/app']['app']['hero.footer.options'])
            ->heroFooterColumnOptions($params['yiisoft/app']['app']['hero.footer.column.options'])
            ->heroFooterColumnLeft($params['yiisoft/app']['app']['hero.footer.column.left'])
            ->heroFooterColumnLeftOptions($params['yiisoft/app']['app']['hero.footer.column.left.options'])
            ->heroFooterColumnCenter($params['yiisoft/app']['app']['hero.footer.column.center'])
            ->heroFooterColumnCenterOptions($params['yiisoft/app']['app']['hero.footer.column.center.options'])
            ->heroFooterColumnRigth($params['yiisoft/app']['app']['hero.footer.column.rigth'])
            ->heroFooterColumnRigthOptions($params['yiisoft/app']['app']['hero.footer.column.rigth.options'])
            ->language($params['yiisoft/app']['app']['language'])
            ->logo($params['yiisoft/app']['app']['logo'])
            ->name($params['yiisoft/app']['app']['name'])
            ->navBarOptions($params['yiisoft/app']['app']['navbar.options'])
            ->navBarBrandOptions($params['yiisoft/app']['app']['navbar.brand.options'])
            ->navBarBrandLogoOptions($params['yiisoft/app']['app']['navbar.brand.logo.options'])
            ->navBarBrandTitleOptions($params['yiisoft/app']['app']['navbar.brand.title.options'])
            ->loggerLevels($params['yiisoft/app']['logger']['levels']);
    },

    /** ROUTER */
    RouteCollectorInterface::class => Group::create(),
    UrlMatcherInterface::class => new RouterFactory(),
    UrlGeneratorInterface::class => UrlGenerator::class
];
