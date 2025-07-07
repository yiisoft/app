<?php

declare(strict_types=1);

namespace App\Asset\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Assets\AssetManager;

/**
 * @psalm-import-type CssFile from AssetManager
 */
final class AppAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@resources/assets/css';

    /**
     * @psalm-var array<array-key, CssFile|string>
     */
    public array $css = [
        'site.css',
    ];
}
