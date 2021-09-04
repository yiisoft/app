<?php

declare(strict_types=1);

use App\Runner\WebApplicationRunner;
use Yiisoft\Arrays\ArrayHelper;

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

define('YII_ENV', getenv('env') ?? 'test');

require_once dirname(__DIR__) . '/vendor/autoload.php';

// get the params web runner
$paramsWebRunner =  require_once dirname(__DIR__) . '/config/params-web-runner.php';
$debug = ArrayHelper::remove($paramsWebRunner, 'debug', true);
$env = ArrayHelper::remove($paramsWebRunner, 'env', true);
$validateContainer = ArrayHelper::remove($paramsWebRunner, 'validateContainer', true);

// Run application:
$runner = new WebApplicationRunner($debug, $env, $validateContainer);
$runner->run();
