<?php

declare(strict_types=1);

use App\DotEnvLoader;
use App\Environment;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load .env file if it exists (for non-Docker environments)
$rootDir = dirname(__DIR__);
$envFile = $rootDir . '/.env';
DotEnvLoader::load($envFile);

Environment::prepare();
