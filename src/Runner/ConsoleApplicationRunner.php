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
use Yiisoft\Yii\Console\Output\ConsoleBufferedOutput;

final class ConsoleApplicationRunner
{
    /**
     * @throws CircularReferenceException|ErrorException|Exception|InvalidConfigException|NotFoundException
     * @throws NotInstantiableException
     */
    public function run(): void
    {
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

        $container = new Container(
            $config->get('console'),
            $config->get('providers-console')
        );

        $container = $container->get(ContainerInterface::class);

        // Run bootstrap
        $this->runBootstrap($container, $config->get('bootstrap-console'));

        /** @var Application */
        $application = $container->get(Application::class);
        $exitCode = 1;

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
