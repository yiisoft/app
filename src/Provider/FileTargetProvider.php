<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Psr\Log\LogLevel;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Log\Target\File\FileRotatorInterface;
use Yiisoft\Log\Target\File\FileTarget;

final class FileTargetProvider extends ServiceProvider
{
    private static string $file;
    private static array $levels;

    public function __construct(
        string $file = '@runtime/logs/app.log',
        array $levels = [LogLevel::EMERGENCY, LogLevel::ERROR, LogLevel::WARNING, LogLevel::INFO, LogLevel::DEBUG]
    ) {
        self::$file = $file;
        self::$levels = $levels;
    }

    public function register(Container $container): void
    {
        $container->set(FileTarget::class, static function (ContainerInterface $container) {
            $aliases = $container->get(Aliases::class);

            $fileTarget = new FileTarget(
                $aliases->get(self::$file),
                $container->get(FileRotatorInterface::class)
            );

            $fileTarget->setLevels(self::$levels);

            return $fileTarget;
        });
    }
}
