<?php

declare(strict_types=1);

use App\DotEnvLoader;
use App\Environment;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load .env file if it exists (for non-Docker environments)
// Skip loading if APP_ENV is already set (Docker/CI optimization)
if (!isset($_ENV['APP_ENV']) && getenv('APP_ENV') === false) {
    $rootDir = dirname(__DIR__);
    $envFile = $rootDir . '/.env';
    DotEnvLoader::load($envFile);
}

Environment::prepare();
