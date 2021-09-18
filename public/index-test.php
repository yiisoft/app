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
    /** @psalm-suppress MixedArgument */
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file(__DIR__ . $path)) {
        return false;
    }

    // Explicitly set for URLs with dot.
    $_SERVER['SCRIPT_NAME'] = '/index-test.php';
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Set debug value for web application runner, for default its `true` add additionally the validation of the
 * container-di configurations (debug mode).
 */
define('YII_DEBUG', getenv('YII_DEBUG') ? (bool)getenv('YII_DEBUG') : true);

/**
 * Set environment value for web application runner, for default its `null`.
 *
 * @link https://github.com/yiisoft/config#environments
 */
define('YII_ENV', getenv('YII_ENV') ?: null);

// Run web application runner
$runner = new WebApplicationRunner(YII_DEBUG, YII_ENV);
$runner->run();
