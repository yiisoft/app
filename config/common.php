<?php

declare(strict_types=1);

use App\LayoutParameters;
use App\Factory\RouterFactory;
use Psr\Container\ContainerInterface;
use Yiisoft\Router\FastRoute\UrlGenerator;
use Yiisoft\Router\Group;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;

return [
    ContainerInterface::class => static function (ContainerInterface $container) {
        return $container;
    },

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

    RouteCollectorInterface::class => Group::create(),
    UrlMatcherInterface::class => new RouterFactory(),
    UrlGeneratorInterface::class => UrlGenerator::class
];
