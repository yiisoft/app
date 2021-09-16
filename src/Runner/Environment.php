<?php

declare(strict_types=1);

namespace App\Runner;

use Dotenv\Dotenv;

use function dirname;

final class Environment
{
    private const DEFAULT_YII_ENV = null;
    private const DEFAULT_YII_DEBUG = true;

    public static function prepare(): void
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();

        $_ENV['YII_ENV'] = empty($_ENV['YII_ENV'])
            ? self::DEFAULT_YII_ENV
            : (string)$_ENV['YII_ENV'];
        $_SERVER['YII_ENV'] = $_ENV['YII_ENV'];

        $_ENV['YII_DEBUG'] = empty($_ENV['YII_DEBUG'])
            ? self::DEFAULT_YII_DEBUG
            : filter_var(
                $_ENV['YII_DEBUG'],
                FILTER_VALIDATE_BOOLEAN,
                FILTER_NULL_ON_FAILURE
            ) ?? self::DEFAULT_YII_DEBUG;
        $_SERVER['YII_DEBUG'] = $_ENV['YII_DEBUG'];
    }
}
