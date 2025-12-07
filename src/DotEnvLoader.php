<?php

declare(strict_types=1);

namespace App;

/**
 * Simple .env file loader for non-Docker environments.
 * Loads environment variables from a .env file.
 */
final class DotEnvLoader
{
    /**
     * Load environment variables from a .env file.
     * Does nothing if the file does not exist.
     *
     * @param string $path Path to the .env file
     */
    public static function load(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            // Skip comments and empty lines
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            // Parse KEY=VALUE format
            $parts = explode('=', $line, 2);
            if (count($parts) !== 2) {
                continue;
            }

            [$key, $value] = $parts;
            $key = trim($key);
            $value = trim($value);

            // Remove quotes if present
            if ((str_starts_with($value, '"') && str_ends_with($value, '"'))
                || (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
                $value = substr($value, 1, -1);
            }

            // Only set if not already set (allows environment to override .env)
            if (!isset($_ENV[$key]) && getenv($key) === false) {
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    }
}
