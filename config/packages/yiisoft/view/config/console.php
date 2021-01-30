<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;
use Yiisoft\View\View;

/** @var array $params */

return [
    View::class => [
        '__class' => View::class,
        '__construct()' => [
            'basePath' => fn (Aliases $aliases) => $aliases->get($params['yiisoft/view']['basePath']),
        ],
    ],
];
