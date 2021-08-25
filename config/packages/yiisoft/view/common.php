<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;
use Yiisoft\Factory\Definition\DynamicReference;
use Yiisoft\View\View;

/** @var array $params */

return [
    View::class => [
        'class' => View::class,
        '__construct()' => [
            'basePath' => DynamicReference::to(static fn (Aliases $aliases) => $aliases->get($params['yiisoft/view']['basePath'])),
        ],
        'setCommonParameters()' => [
            $params['yiisoft/view']['commonParameters'],
        ],
        'reset' => function () {
            $this->clear();
        },
    ],
];
