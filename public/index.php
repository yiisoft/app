<?php

declare(strict_types=1);

use App\Runner\WebApplicationRunner;

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    if (is_file(__DIR__ . $_SERVER['REQUEST_URI'])) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}

define('YII_ENV', getenv('env') ?? 'production');

require_once dirname(__DIR__) . '/vendor/autoload.php';

$runner = new WebApplicationRunner();
// Development mode:
$runner->debug();
// Run application:
$runner->run();
