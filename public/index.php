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

/**
 *  Set debug value for web application runner, for default its `true` add additionally the validation of the
 *  container-di configurations (debug mode).
 */
define('YII_DEBUG', getenv('YII_DEBUG') ?: true);

/**
 *  Set environment value for web application runner, for default its `null`.
 *
 *  @link https://github.com/yiisoft/config#environments
 */
define('YII_ENV', getenv('YII_ENV') ?: null);

// Run web application runner
$runner = new WebApplicationRunner(YII_DEBUG, YII_ENV);
$runner->run();
