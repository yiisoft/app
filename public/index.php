<?php

declare(strict_types=1);

use App\Runner\WebApplicationRunner;
use Yiisoft\Arrays\ArrayHelper;

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

// get the params web runner
$paramsWebRunner =  require_once dirname(__DIR__) . '/config/params-web-runner.php';
$debug = ArrayHelper::remove($paramsWebRunner, 'debug', true);
$env = ArrayHelper::remove($paramsWebRunner, 'env', true);
$validateContainer = ArrayHelper::remove($paramsWebRunner, 'validateContainer', true);

// Run application:
$runner = new WebApplicationRunner($debug, $env, $validateContainer);
$runner->run();
