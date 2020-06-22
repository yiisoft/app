<?php

declare(strict_types=1);

namespace App\Asset;

use Yiisoft\Assets\AssetBundle;

class BulmaAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm';

    public array $css = [
        'bulma/css/bulma.css',
        'bulma-helpers/css/bulma-helpers.css'
    ];

    public array $js = [
        '@vizuaalog/bulmajs/dist/file.js',
        '@vizuaalog/bulmajs/dist/navbar.js',
    ];

    public array $publishOptions = [
        'only' => [
            'bulma/css/bulma.css',
            'bulma-helpers/css/bulma-helpers.css',
            '@vizuaalog/bulmajs/dist/file.js',
            '@vizuaalog/bulmajs/dist/navbar.js',
        ],
    ];
}
