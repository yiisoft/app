<?php

declare(strict_types=1);

namespace App\Layout\Main;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Assets\AssetManager;

/**
 * @psalm-import-type CssFile from AssetManager
 */
final class MainAsset extends AssetBundle
{
    public ?string $basePath = '@assets/main';
    public ?string $baseUrl = '@assetsUrl/main';
    public ?string $sourcePath = '@assetsSource/main';

    /**
     * @psalm-var array<array-key, CssFile|string>
     */
    public array $css = [
        'site.css',
    ];
}
