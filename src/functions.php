<?php

declare(strict_types=1);

use Yiisoft\VarDumper\VarDumper;

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
