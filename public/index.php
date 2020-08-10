<?php

declare(strict_types=1);

use Yiisoft\Composer\Config\Builder;
use Yiisoft\Di\Container;
use Yiisoft\Http\Method;
use Yiisoft\Yii\Web\Application;
use Yiisoft\Yii\Web\SapiEmitter;
use Yiisoft\Yii\Web\ServerRequestFactory;

$autoload = dirname(__DIR__) . '/vendor/autoload.php';
$c3 = dirname(__DIR__) . '/c3.php';

if (is_file($c3)) {
    require_once $c3;
}

if (!is_file($autoload)) {
    die('You need to set up the project dependencies using Composer');
}

require_once $autoload;

// Don't do it in production, assembling takes it's time
Builder::rebuild();
$startTime = microtime(true);

$container = new Container(
    require Builder::path('web'),
    require Builder::path('providers-web')
);

$application = $container->get(Application::class);

$request = $container->get(ServerRequestFactory::class)->createFromGlobals();
$request = $request->withAttribute('applicationStartTime', $startTime);

try {
    $application->start();
    $response = $application->handle($request);
    $emitter = new SapiEmitter();
    $emitter->emit($response, $request->getMethod() === Method::HEAD);
} finally {
    $application->afterEmit($response ?? null);
    $application->shutdown();
}
