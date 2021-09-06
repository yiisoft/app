<?php

declare(strict_types=1);

use App\Runner\WebApplicationRunner;

$c3 = dirname(__DIR__) . '/c3.php';

if (is_file($c3)) {
    require_once $c3;
}

// PHP built-in server routing.
if (PHP_SAPI === 'cli-server') {
    // Serve static files as is.
    if (is_file(__DIR__ . $_SERVER["REQUEST_URI"])) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index-test.php';
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Run web application runner
$params =  require_once dirname(__DIR__) . '/config/params-web-runner.php';
$runner = new WebApplicationRunner(
    $params['debug'] ?? true,
    $params['environment'] ?? null,
    $params['validateContainer'] ?? true,
);
$runner->run();
