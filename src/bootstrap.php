<?php

declare(strict_types=1);

use App\Environment;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Load .env for non-Docker/non-container environments.
// Existing process environment variables take precedence (Docker, CI, server config).
(Dotenv\Dotenv::createImmutable(dirname(__DIR__)))->safeLoad();

Environment::prepare();
