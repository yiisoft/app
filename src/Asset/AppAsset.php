<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaJsAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaHelpersAsset;

class AppAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@resources/assets/css';

    public array $css = [
        'site.css'
    ];

    public array $depends = [
        BulmaAsset::class,
        BulmaHelpersAsset::class,
        BulmaJsAsset::class,
    ];
}
