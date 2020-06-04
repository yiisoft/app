<?php

declare(strict_types=1);

namespace App\Provider;

use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Log\Target\File\FileRotator;
use Yiisoft\Log\Target\File\FileRotatorInterface;

final class FileRotatorProvider extends ServiceProvider
{
    private static int $maxFileSize;
    private static int $maxFiles;
    private static ?int $fileMode;
    private static ?bool $rotateByCopy;

    public function __construct(
        int $maxFileSize = 10,
        int $maxFiles = 5,
        ?int $fileMode = null,
        ?bool $rotateByCopy = null
    ) {
        self::$maxFileSize = $maxFileSize;
        self::$maxFiles = $maxFiles;
        self::$fileMode = $fileMode;
        self::$rotateByCopy = $rotateByCopy;
    }

    public function register(Container $container): void
    {
        $container->set(FileRotatorInterface::class, static function () {

            return new FileRotator(self::$maxFileSize, self::$maxFiles, self::$fileMode, self::$rotateByCopy);
        });
    }
}
