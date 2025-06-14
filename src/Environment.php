<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

use function in_array;

final class Environment
{
    public const DEVELOPMENT = 'development';
    public const TESTING = 'testing';
    public const PRODUCTION = 'production';

    private static array $values = [];

    public static function prepare(): void
    {
        self::setEnvironment();
        self::setBoolean('YII_C3', false);
        self::setBoolean('YII_DEBUG', false);
    }

    /**
     * @return non-empty-string
     */
    public static function environment(): string
    {
        return self::$values['YII_ENV'];
    }

    public static function isDevelopment(): bool
    {
        return self::environment() === self::DEVELOPMENT;
    }

    public static function isTesting(): bool
    {
        return self::environment() === self::TESTING;
    }

    public static function isProduction(): bool
    {
        return self::environment() === self::PRODUCTION;
    }

    public static function yiiC3(): bool
    {
        return self::$values['YII_C3'];
    }

    public static function yiiDebug(): bool
    {
        return self::$values['YII_DEBUG'];
    }

    private static function setEnvironment(): void
    {
        $environment = self::getRawValue('YII_ENV');
        if (!in_array($environment, [self::DEVELOPMENT, self::TESTING, self::PRODUCTION], true)) {
            throw new RuntimeException('Invalid environment.');
        }
        self::$values['YII_ENV'] = $environment;
    }

    private static function setBoolean(string $key, bool $default): void
    {
        $value = self::getRawValue($key);
        self::$values[$key] = $value === null
            ? $default
            : (filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? $default);
    }

    private static function setInteger(string $key, int $default): void
    {
        $value = self::getRawValue($key);
        self::$values[$key] = $value === null ? $default : (int) $value;
    }

    private static function setString(string $key, string $default): void
    {
        $value = self::getRawValue($key);
        self::$values[$key] = $value ?? $default;
    }

    private static function getRawValue(string $key): ?string
    {
        $value = getenv($key, true);
        if ($value !== false) {
            return $value;
        }

        $value = getenv($key);
        if ($value !== false) {
            return $value;
        }

        return $_ENV[$key] ?? null;
    }
}
