<?php

declare(strict_types=1);

namespace App\Runner;

use App\Handler\ThrowableHandler;
use ErrorException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use Yiisoft\Config\Config;
use Yiisoft\Di\Container;
use Yiisoft\ErrorHandler\ErrorHandler;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\ErrorHandler\Renderer\HtmlRenderer;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotFoundException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Http\Method;
use Yiisoft\Log\Logger;
use Yiisoft\Log\Target\File\FileTarget;
use Yiisoft\Yii\Event\ListenerConfigurationChecker;
use Yiisoft\Yii\Web\Application;
use Yiisoft\Yii\Web\Exception\HeadersHaveBeenSentException;
use Yiisoft\Yii\Web\SapiEmitter;
use Yiisoft\Yii\Web\ServerRequestFactory;

use function dirname;
use function microtime;

final class WebApplicationRunner
{
    private bool $debug = false;

    public function debug(bool $enable = true): void
    {
        $this->debug = $enable;
    }

    /**
     * @throws CircularReferenceException|ErrorException|HeadersHaveBeenSentException|InvalidConfigException
     * @throws NotFoundException|NotInstantiableException|
     */
    public function run(): void
    {
        $startTime = microtime(true);

        // Register temporary error handler to catch error while container is building.
        $errorHandler = $this->createTemporaryErrorHandler();
        $this->registerErrorHandler($errorHandler);

        $config = new Config(
            dirname(__DIR__, 2),
            '/config/packages', // Configs path.
            null,
            [
                'params',
                'events',
                'events-web',
                'events-console',
            ],
        );

        $container = new Container($config->get('web'), $config->get('providers-web'));

        // Register error handler with real container-configured dependencies.
        $this->registerErrorHandler($container->get(ErrorHandler::class), $errorHandler);

        // Run bootstrap
        $this->runBootstrap($container, $config->get('bootstrap-web'));

        $container = $container->get(ContainerInterface::class);

        if ($this->debug) {
            /** @psalm-suppress MixedMethodCall */
            $container->get(ListenerConfigurationChecker::class)->check($config->get('events-web'));
        }

        /** @var Application */
        $application = $container->get(Application::class);

        /**
         * @var ServerRequestInterface
         * @psalm-suppress MixedMethodCall
         */
        $serverRequest = $container->get(ServerRequestFactory::class)->createFromGlobals();
        $request = $serverRequest->withAttribute('applicationStartTime', $startTime);

        try {
            $application->start();
            $response = $application->handle($request);
            $this->emit($request, $response);
        } catch (Throwable $throwable) {
            $handler = new ThrowableHandler($throwable);
            /**
             * @var ResponseInterface
             * @psalm-suppress MixedMethodCall
             */
            $response = $container->get(ErrorCatcher::class)->process($request, $handler);
            $this->emit($request, $response);
        } finally {
            $application->afterEmit($response ?? null);
            $application->shutdown();
        }
    }

    private function createTemporaryErrorHandler(): ErrorHandler
    {
        $logger = new Logger([new FileTarget(dirname(__DIR__) . '/runtime/logs/app.log')]);
        return new ErrorHandler($logger, new HtmlRenderer());
    }

    /**
     * @throws HeadersHaveBeenSentException
     */
    private function emit(RequestInterface $request, ResponseInterface $response): void
    {
        (new SapiEmitter())->emit($response, $request->getMethod() === Method::HEAD);
    }

    /**
     * @throws ErrorException
     */
    private function registerErrorHandler(ErrorHandler $registered, ErrorHandler $unregistered = null): void
    {
        if ($unregistered !== null) {
            $unregistered->unregister();
        }

        if ($this->debug) {
            $registered->debug();
        }

        $registered->register();
    }

    private function runBootstrap(Container $container, array $bootstrapList): void
    {
        (new BootstrapRunner($container, $bootstrapList))->run();
    }
}
