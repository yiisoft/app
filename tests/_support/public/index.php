<?php

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Di\Container;
use Yiisoft\Http\Method;
use Yiisoft\Yii\Web\Application;
use Yiisoft\Yii\Web\ErrorHandler\ErrorHandler;
use Yiisoft\Yii\Web\ErrorHandler\HtmlRenderer;
use Yiisoft\Yii\Web\ErrorHandler\ThrowableRendererInterface;
use Yiisoft\Yii\Web\SapiEmitter;
use Yiisoft\Yii\Web\ServerRequestFactory;

require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$c3 = dirname(__DIR__, 3) . '/c3.php';

if (is_file($c3)) {
    require_once $c3;
}

// Don't do it in production, assembling takes it's time
Builder::rebuild();
$startTime = microtime(true);

/**
 * Register temporary error handler to catch error while container is building.
 */
$errorHandler = new ErrorHandler(new NullLogger(), new HtmlRenderer());
/**
 * Production mode
 * $errorHandler = $errorHandler->withoutExposedDetails();
 */
$errorHandler->register();

$container = new Container(
    require Builder::path('web'),
    require Builder::path('providers-web')
);

$aliases = $container->get(Aliases::class);

$aliases->set('@public', __DIR__);
$aliases->set('@assets', '@public/assets');

/**
 * Configure error handler with real container-configured dependencies
 */
$errorHandler->setLogger($container->get(LoggerInterface::class));
$errorHandler->setRenderer($container->get(ThrowableRendererInterface::class));

$container = $container->get(ContainerInterface::class);
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
