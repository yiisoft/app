<?php

declare(strict_types=1);

use App\LayoutParameters;
use Yiisoft\Yii\Web\Session\Session;
use Yiisoft\Yii\Web\Session\SessionInterface;

return [
    SessionInterface::class => [
        '__class' => Session::class,
        '__construct()' => [
            $params['app']['session']['options'] ?? [],
            $params['app']['session']['handler'] ?? null,
        ],
    ],

    LayoutParameters::class => static function () use ($params) {
        $layoutParameters = new LayoutParameters();

        return $layoutParameters
            ->brandUrl($params['app']['brandurl'])
            ->charset($params['app']['charset'])
            ->heroOptions($params['app']['hero.options'])
            ->heroHeadOptions($params['app']['hero.head.options'])
            ->heroBodyOptions($params['app']['hero.body.options'])
            ->heroContainerOptions($params['app']['hero.container.options'])
            ->heroFooterOptions($params['app']['hero.footer.options'])
            ->heroFooterColumnOptions($params['app']['hero.footer.column.options'])
            ->heroFooterColumnLeft($params['app']['hero.footer.column.left'])
            ->heroFooterColumnLeftOptions($params['app']['hero.footer.column.left.options'])
            ->heroFooterColumnCenter($params['app']['hero.footer.column.center'])
            ->heroFooterColumnCenterOptions($params['app']['hero.footer.column.center.options'])
            ->heroFooterColumnRigth($params['app']['hero.footer.column.rigth'])
            ->heroFooterColumnRigthOptions($params['app']['hero.footer.column.rigth.options'])
            ->language($params['app']['language'])
            ->logo($params['app']['logo'])
            ->name($params['app']['name'])
            ->navBarOptions($params['app']['navbar.options'])
            ->navBarBrandOptions($params['app']['navbar.brand.options'])
            ->navBarBrandLogoOptions($params['app']['navbar.brand.logo.options'])
            ->navBarBrandTitleOptions($params['app']['navbar.brand.title.options'])
            ->loggerLevels($params['app']['logger']['levels'])
            ->loggerFile($params['app']['logger']['file'])
            ->MaxFileSize($params['app']['filerotator']['maxfilesize'])
            ->MaxFiles($params['app']['filerotator']['maxfiles'])
            ->FileMode($params['app']['filerotator']['filemode'])
            ->RotateByCopy($params['app']['filerotator']['rotatebycopy']);
    },
];
