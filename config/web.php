<?php

declare(strict_types=1);

use App\ApplicationParameters;

/* @var array $params */

return [
    ApplicationParameters::class => static function () use ($params) {
        return (new ApplicationParameters())
            ->charset($params['app']['charset'])
            ->language($params['app']['language'])
            ->locale($params['app']['locale'])
            ->name($params['app']['name']);
    },
];
