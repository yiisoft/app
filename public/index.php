<?php

declare(strict_types=1);

use App\Runner\WebApplicationRunner;

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file(__DIR__ . $path)) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Run web application runner
$runner = new WebApplicationRunner(filter_var($_ENV['YII_DEBUG'], FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE), $_ENV['YII_ENV']);
$runner->run();
