<?php

declare(strict_types=1);

use App\ApplicationParameters;

/** @var array $params */

return [
    ApplicationParameters::class => [
        '__class' => ApplicationParameters::class,
        'charset()' => [$params['app']['charset']],
        'language()' => [$params['app']['language']],
        'name()' => [$params['app']['name']],
    ],
];
