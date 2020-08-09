<?php

declare(strict_types=1);

use App\ApplicationParameters;
use App\ViewRenderer;
use Yiisoft\Validator\ValidatorFactory;
use Yiisoft\Validator\ValidatorFactoryInterface;

/* @var array $params */

return [
    ApplicationParameters::class => static function () use ($params) {
        return (new ApplicationParameters())
            ->csrfAttribute($params['app']['csrfAttribute'])
            ->charset($params['app']['charset'])
            ->language($params['app']['language'])
            ->name($params['app']['name']);
    },

    ValidatorFactoryInterface::class => ValidatorFactory::class,
    ViewRenderer::class => [
        '__construct()' => [
            'viewBasePath' => '@views',
            'layout' => '@resources/layout/main',
        ],
    ],
];
