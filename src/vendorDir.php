<?php

declare(strict_types=1);

use App\Environment;

final class Vendor{
    public static readonly string $directory;
    function __construct() {
        static::$directory = json_decode(file_get_contents("composer.json"))->config->{"vendor-dir"};
        if (!file_exists($directory)) {//!yii server
            $directory = "../$directory";//yii3 require relative path
        }
        file_exists(Vendor::$directory) || throw new Exception("file_exists(vendorDir: Vendor::$directory)");
    }
}
return Vendor::$directory;