<?php

declare(strict_types=1);

use Yiisoft\Factory\Definitions\Reference;

return [
    Yiisoft\Yii\Web\Application::class => [
        'class' => Yiisoft\Yii\Web\Application::class,
        '__construct()' => [
            'dispatcher' => Reference::to('application-dispatcher')
        ],
    ],
];
