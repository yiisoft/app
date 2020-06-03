<?php

declare(strict_types=1);

namespace App\Provider;

use App\LayoutParameters;
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
        $container->set(FileRotatorInterface::class, static function () {
            return new FileRotator(10);
        });

        $container->set(FileTarget::class, static function (ContainerInterface $container) {
            $layoutParameters = $container->get(LayoutParameters::class);

            $fileTarget = new FileTarget(
                $container->get(Aliases::class)->get('@runtime/logs/app.log'),
                $container->get(FileRotatorInterface::class)
            );

            $fileTarget->setLevels($layoutParameters->getLoggerLevels());

            return $fileTarget;
        });

        $container->set(LoggerInterface::class, static function (ContainerInterface $container) {
            return new Logger(['file' => $container->get(FileTarget::class)]);
        });
    }
}
