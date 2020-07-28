<?php

declare(strict_types=1);

use App\ApplicationParameters;
use Yiisoft\Validator\ValidatorFactory;
use Yiisoft\Validator\ValidatorFactoryInterface;

/* @var array $params */

return [
    ApplicationParameters::class => static function () use ($params) {
        return (new ApplicationParameters())
            ->charset($params['app']['charset'])
            ->language($params['app']['language'])
            ->name($params['app']['name']);
    },

    ValidatorFactoryInterface::class => ValidatorFactory::class,
];
