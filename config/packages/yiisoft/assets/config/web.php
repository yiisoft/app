<?php

declare(strict_types=1);

use Yiisoft\Assets\AssetConverter;
use Yiisoft\Assets\AssetConverterInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Assets\AssetPublisherInterface;
use Yiisoft\Factory\Definitions\Reference;

/** @var array $params */

return [
    AssetConverterInterface::class => [
        '__class' => AssetConverter::class,
        'setCommand()' => [
            $params['yiisoft/assets']['assetConverter']['command']['from'],
            $params['yiisoft/assets']['assetConverter']['command']['to'],
            $params['yiisoft/assets']['assetConverter']['command']['command'],
        ],
        'setForceConvert()' => [$params['yiisoft/assets']['assetConverter']['forceConvert']],
    ],

    AssetPublisherInterface::class => [
        '__class' => AssetPublisher::class,
        'setAppendTimestamp()' => [$params['yiisoft/assets']['assetPublisher']['appendTimestamp']],
        'setAssetMap()' => [$params['yiisoft/assets']['assetPublisher']['assetMap']],
        'setBasePath()' => [$params['yiisoft/assets']['assetPublisher']['basePath']],
        'setBaseUrl()' => [$params['yiisoft/assets']['assetPublisher']['baseUrl']],
        'setForceCopy()' => [$params['yiisoft/assets']['assetPublisher']['forceCopy']],
        'setLinkAssets()' => [$params['yiisoft/assets']['assetPublisher']['linkAssets']],
    ],

    AssetManager::class => [
        '__class' => AssetManager::class,
        'setConverter()' => [Reference::to(AssetConverterInterface::class)],
        'setBundles()' => [$params['yiisoft/assets']['assetManager']['bundles']],
        'register()' => [$params['yiisoft/assets']['assetManager']['register']],
    ],
];
