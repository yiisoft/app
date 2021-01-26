<?php

declare(strict_types=1);

use Yiisoft\I18n\Locale;

return [
    Locale::class => [
        'class' => Locale::class,
        '__construct()' => [
            $params['app']['locale'],
        ],
    ],
];
