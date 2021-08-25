<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;

/* @var array $params */

return [
    Aliases::class => [
        'class' => Aliases::class,
        '__construct()' => [$params['yiisoft/aliases']['aliases']],
    ],
];
