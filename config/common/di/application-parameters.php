<?php

declare(strict_types=1);

use App\ApplicationParameters;

/** @var array $params */

return [
    ApplicationParameters::class => [
        '__construct()' => [
            'name' => $params['app']['name'],
            'charset' => $params['app']['charset'],
            'locale' => $params['app']['locale'],
        ],
    ],
];
