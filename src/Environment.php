<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

use function in_array;
use function sprintf;

final class Environment
{
    public const DEV = 'dev';
    public const TEST = 'test';
    public const PROD = 'prod';

    private static array $values = [];

    public static function prepare(): void
    {
        self::setEnvironment();
        self::setBoolean('APP_C3', false);
        self::setBoolean('APP_DEBUG', false);
    }

    /**
     * @return non-empty-string
     */
    public static function appEnv(): string
    {
        /** @var non-empty-string */
        return self::$values['APP_ENV'];
    }

    public static function isDev(): bool
    {
        return self::appEnv() === self::DEV;
    }

    public static function isTest(): bool
    {
        return self::appEnv() === self::TEST;
    }

    public static function isProd(): bool
    {
        return self::appEnv() === self::PROD;
    }

    public static function appC3(): bool
    {
        /** @var bool */
        return self::$values['APP_C3'];
    }

    public static function appDebug(): bool
    {
        /** @var bool */
        return self::$values['APP_DEBUG'];
    }

    private static function setEnvironment(): void
    {
        $environment = self::getRawValue('APP_ENV');
        if (!in_array($environment, [self::DEV, self::TEST, self::PROD], true)) {
            throw new RuntimeException(
                sprintf('"%s" is invalid environment.', $environment ?? '')
            );
        }
        self::$values['APP_ENV'] = $environment;
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

        return isset($_ENV[$key]) ? (string) $_ENV[$key] : null;
    }
}
