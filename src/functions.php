<?php

declare(strict_types=1);

use Yiisoft\Files\FileHelper;

function shouldRebuildConfigs(): bool
{
    $sourceDirectory = dirname(__DIR__) . '/config/';
    $buildDirectory = dirname(__DIR__) . '/runtime/build/config/';

    if (FileHelper::isEmptyDirectory($buildDirectory)) {
        return true;
    }

    $sourceTime = FileHelper::lastModifiedTime($sourceDirectory);
    $buildTime = FileHelper::lastModifiedTime($buildDirectory);
    return $buildTime < $sourceTime;
}
