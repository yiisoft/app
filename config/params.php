<?php

declare(strict_types=1);

use Psr\Log\LogLevel;

return [
    'yiisoft/app' => [
        'app' => [
            'brandurl' => '/',
            'charset' => 'UTF-8',
            'hero.options' => ['class' => 'hero is-fullheight is-light'],
            'hero.head.options' => ['class' => 'hero-head has-background-black'],
            'hero.body.options' => ['class' => 'hero-body is-light'],
            'hero.container.options' => ['class' => 'container has-text-centered'],
            'hero.footer.options' => ['class' => 'hero-footer has-background-black'],
            'hero.footer.column.options' => ['class' => 'columns is-mobile'],
            'hero.footer.column.left' => 'Left',
            'hero.footer.column.left.options' => ['class' => 'column has-text-left has-text-light'],
            'hero.footer.column.center' => 'Center',
            'hero.footer.column.center.options' => ['class' => 'column has-text-centered has-text-light'],
            'hero.footer.column.rigth' => 'Rigth',
            'hero.footer.column.rigth.options' => ['class' => 'column has-text-right has-text-light'],
            'language' => 'en',
            'logo' => '/images/yii-logo.jpg',
            'name' => 'My Project',
            'navbar.options' => ['class' => 'navbar'],
            'navbar.brand.options' => ['class' => 'navbar-brand'],
            'navbar.brand.logo.options' => ['class' => 'navbar-item'],
            'navbar.brand.title.options' => ['class' => 'navbar-item has-text-light'],
        ],
        'logger' => [
            'levels' => [
                LogLevel::EMERGENCY,
                LogLevel::ERROR,
                LogLevel::WARNING,
                LogLevel::INFO,
                LogLevel::DEBUG,
            ],
        ],
        'session' => [
            'options' => ['cookie_secure' => 0],
        ],
    ],

    'yiisoft/yii-debug' => [
        'enabled' => true
    ],
];
