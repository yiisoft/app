<?php

declare(strict_types=1);

use App\ApplicationRunner;

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    if (is_file(__DIR__ . $_SERVER['REQUEST_URI'])) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Development mode:
$runner = ApplicationRunner::forDevelopment();
// Production mode:
//$runner = ApplicationRunner::forProduction();
// Run application:
$runner->run();
