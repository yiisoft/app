<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Assets\AssetBundle;

class AppAsset extends AssetBundle
{
    public ?string $basePath = '@basePath';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@app/resources/assets/css';

    public array $css = [
        'site.css'
    ];

    public array $depends = [
        BulmaAsset::class
    ];
}
