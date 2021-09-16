<?php

declare(strict_types=1);

namespace App\Runner;

use Error;
use ErrorException;
use Exception;
use Psr\Container\ContainerInterface;
use Yiisoft\Config\Config;
use Yiisoft\Di\Container;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotFoundException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Yii\Console\Application;
use Yiisoft\Yii\Console\ExitCode;
use Yiisoft\Yii\Console\Output\ConsoleBufferedOutput;

use function dirname;

final class ConsoleApplicationRunner
{
    private bool $debug;
    private ?string $environment;

    public function __construct(bool $debug, ?string $environment)
    {
        $this->debug = $debug;
        $this->environment = $environment;
    }

    /**
     * @throws CircularReferenceException|ErrorException|Exception|InvalidConfigException|NotFoundException
     * @throws NotInstantiableException
     */
    public function run(): void
    {
        $config = new Config(
            dirname(__DIR__, 2),
            '/config/packages', // Configs path.
            $this->environment,
            [
                'params',
                'events',
                'events-web',
                'events-console',
            ],
        );

        $container = new Container(
            $config->get('console'),
            $config->get('providers-console'),
            [],
            $this->debug,
            $config->get('delegates-console')
        );

        $container = $container->get(ContainerInterface::class);

        // Run bootstrap
        $this->runBootstrap($container, $config->get('bootstrap-console'));

        /** @var Application */
        $application = $container->get(Application::class);
        $exitCode = ExitCode::UNSPECIFIED_ERROR;

        try {
            $application->start();
            $exitCode = $application->run(null, new ConsoleBufferedOutput());
        } catch (Error $error) {
            $application->renderThrowable($error, new ConsoleBufferedOutput());
        } finally {
            $application->shutdown($exitCode);
            exit($exitCode);
        }
    }

    private function runBootstrap(ContainerInterface $container, array $bootstrapList): void
    {
        (new BootstrapRunner($container, $bootstrapList))->run();
    }
}
