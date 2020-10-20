<?php

declare(strict_types=1);

/* @var array $params */

return [
    \App\BootstrapHandler::class => [
        '__class' => \App\BootstrapHandler::class,
        '__construct()' => ['callbacks' => [
            [\App\TestBootstrap::class, 'bootstrap'],
        ]],
    ],
];
