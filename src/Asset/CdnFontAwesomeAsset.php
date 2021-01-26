<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Assets\AssetBundle;

final class CdnFontAwesomeAsset extends AssetBundle
{
    public bool $cdn = true;
    public ?string $baseUrl = 'https://use.fontawesome.com';

    public array $css = [
        '/releases/v5.13.0/css/all.css',
    ];
}
