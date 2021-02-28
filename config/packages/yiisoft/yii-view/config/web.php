<?php

declare(strict_types=1);

/**
 * @var array $params
 */

use Yiisoft\Yii\View\ViewRenderer;

return [
    ViewRenderer::class => [
        '__construct()' => [
            'viewBasePath' => $params['yiisoft/yii-view']['viewBasePath'],
            'layout' => $params['yiisoft/yii-view']['layout'],
            'injections' => $params['yiisoft/yii-view']['injections'],
        ],
    ],
];
