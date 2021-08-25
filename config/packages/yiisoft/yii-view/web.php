<?php

declare(strict_types=1);

use Yiisoft\Yii\View\ViewRenderer;

/** @var array $params */

return [
    ViewRenderer::class => [
        '__construct()' => [
            'viewPath' => $params['yiisoft/yii-view']['viewPath'],
            'layout' => $params['yiisoft/yii-view']['layout'],
            'injections' => $params['yiisoft/yii-view']['injections'],
        ],
    ],
];
