<?php

declare(strict_types=1);

use Yiisoft\Files\FileHelper;
use Yiisoft\VarDumper\VarDumper;

function shouldRebuildConfigs(): bool {
    $sourceDirectory = dirname(__DIR__) . '/config/';
    $buildDirectory = dirname(__DIR__) . '/runtime/build/config/';

    if (FileHelper::isEmptyDirectory($buildDirectory)) {
        return true;
    }

    $sourceTime = FileHelper::lastModifiedTime($sourceDirectory);
    $buildTime = FileHelper::lastModifiedTime($buildDirectory);
    return $buildTime < $sourceTime;
}

if (!function_exists('d')) {
    function d(...$variables)
    {
        foreach ($variables as $variable) {
            VarDumper::dump($variable, 10, PHP_SAPI !== 'cli');
        }
    }
}

if (!function_exists('dd')) {
    function dd(...$variables)
    {
        foreach ($variables as $variable) {
            VarDumper::dump($variable, 10, PHP_SAPI !== 'cli');
        }
        die();
    }
}
