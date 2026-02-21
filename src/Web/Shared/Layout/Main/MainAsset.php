<?php

declare(strict_types=1);

namespace App\Web\Shared\Layout\Main;

use Yiisoft\Assets\AssetBundle;

final class MainAsset extends AssetBundle
{
    #[\Override]
    public ?string $basePath = '@assets/main';
    #[\Override]
    public ?string $baseUrl = '@assetsUrl/main';
    #[\Override]
    public ?string $sourcePath = '@assetsSource/main';

    #[\Override]
    public array $css = [
        'site.css',
    ];
}
