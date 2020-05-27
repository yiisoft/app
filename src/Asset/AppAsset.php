<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Assets\AssetBundle;

class AppAsset extends AssetBundle
{
    public ?string $basePath = '@basePath';
    public ?string $baseUrl = '@web';
    public ?string $sourcePath = __DIR__ . '/css';

    public array $css = [
        'site.css'
    ];
}
