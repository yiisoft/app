<?php

declare(strict_types=1);

namespace App\Provider;

use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Log\Target\File\FileRotator;
use Yiisoft\Log\Target\File\FileRotatorInterface;

final class FileRotatorProvider extends ServiceProvider
{
    private int $maxFileSize;
    private int $maxFiles;
    private ?int $fileMode;
    private ?bool $rotateByCopy;

    public function __construct(
        int $maxFileSize = 10,
        int $maxFiles = 5,
        ?int $fileMode = null,
        ?bool $rotateByCopy = null
    ) {
        $this->maxFileSize = $maxFileSize;
        $this->maxFiles = $maxFiles;
        $this->fileMode = $fileMode;
        $this->rotateByCopy = $rotateByCopy;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(
            FileRotatorInterface::class,
            fn () => new FileRotator($this->maxFileSize, $this->maxFiles, $this->fileMode, $this->rotateByCopy)
        );
    }
}
