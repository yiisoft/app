<?php

declare(strict_types=1);

use App\Environment;
use Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load .env file if it exists (for non-Docker environments)
// Skip loading if APP_ENV is already set (Docker/CI optimization)
if (!isset($_ENV['APP_ENV']) && getenv('APP_ENV') === false) {
    $rootDir = dirname(__DIR__);
    if (file_exists($rootDir . '/.env')) {
        $dotenv = Dotenv::createImmutable($rootDir);
        $dotenv->safeLoad();
    }
}

Environment::prepare();
