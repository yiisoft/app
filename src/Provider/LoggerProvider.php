<?php

declare(strict_types=1);

namespace App\Provider;

use App\ApplicationParameters;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Log\Logger;
use Yiisoft\Log\Target\File\FileRotator;
use Yiisoft\Log\Target\File\FileRotatorInterface;
use Yiisoft\Log\Target\File\FileTarget;

final class LoggerProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->set(FileRotatorInterface::class, static function (ContainerInterface $container) {
            $applicationParameters = $container->get(ApplicationParameters::class);

            return new FileRotator(
                $applicationParameters->getFileRotatorMaxFileSize(),
                $applicationParameters->getFileRotatorMaxFiles(),
                $applicationParameters->getFileRotatorFileMode(),
                $applicationParameters->getFileRotatorRotateByCopy()
            );
        });

        $container->set(FileTarget::class, static function (ContainerInterface $container) {
            $aliases = $container->get(Aliases::class);
            $applicationParameters = $container->get(ApplicationParameters::class);

            $fileTarget = new FileTarget(
                $aliases->get($applicationParameters->getLoggerFile()),
                $container->get(FileRotatorInterface::class)
            );

            $fileTarget->setLevels($applicationParameters->getLoggerLevels());

            return $fileTarget;
        });

        $container->set(LoggerInterface::class, static function (ContainerInterface $container) {
            return new Logger(['file' => $container->get(FileTarget::class)]);
        });
    }
}
