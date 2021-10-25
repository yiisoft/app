<?php

declare(strict_types=1);

namespace App\Runner;

use Yiisoft\Config\Config;
use Yiisoft\Config\ConfigPaths;
use Yiisoft\Config\Modifier\RecursiveMerge;
use Yiisoft\Config\Modifier\ReverseMerge;

use function dirname;

final class ConfigFactory
{
    public static function create(?string $environment): Config
    {
        $eventGroups = [
            'events',
            'events-web',
            'events-console',
        ];

        return new Config(
            new ConfigPaths(dirname(__DIR__, 2), 'config'),
            $environment,
            [
                ReverseMerge::groups(...$eventGroups),
                RecursiveMerge::groups('params', ...$eventGroups),
            ],
        );
    }
}
