<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetConverter;
use Yiisoft\Assets\AssetConverterInterface;
use Yiisoft\Assets\AssetLoader;
use Yiisoft\Assets\AssetLoaderInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Assets\AssetPublisherInterface;
use Yiisoft\Factory\Definition\Reference;

/** @var array $params */

return [
    AssetConverterInterface::class => [
        'class' => AssetConverter::class,
        '__construct()' => [
            Reference::to(Aliases::class),
            Reference::to(LoggerInterface::class),
            $params['yiisoft/assets']['assetConverter']['commands'],
            $params['yiisoft/assets']['assetConverter']['forceConvert'],
        ],
    ],

    AssetLoaderInterface::class => [
        'class' => AssetLoader::class,
        '__construct()' => [
            Reference::to(Aliases::class),
            $params['yiisoft/assets']['assetLoader']['appendTimestamp'],
            $params['yiisoft/assets']['assetLoader']['assetMap'],
            $params['yiisoft/assets']['assetLoader']['basePath'],
            $params['yiisoft/assets']['assetLoader']['baseUrl'],
        ],
    ],

    AssetPublisherInterface::class => [
        'class' => AssetPublisher::class,
        '__construct()' => [
            Reference::to(Aliases::class),
            $params['yiisoft/assets']['assetPublisher']['forceCopy'],
            $params['yiisoft/assets']['assetPublisher']['linkAssets'],
        ],
    ],

    AssetManager::class => static function (ContainerInterface $container) use ($params): AssetManager {
        $assetManager = new AssetManager(
            $container->get(Aliases::class),
            $container->get(AssetLoaderInterface::class),
            $params['yiisoft/assets']['assetManager']['allowedBundleNames'],
            $params['yiisoft/assets']['assetManager']['customizedBundles'],
        );

        $assetManager = $assetManager
            ->withConverter($container->get(AssetConverterInterface::class))
            ->withPublisher($container->get(AssetPublisherInterface::class))
        ;

        $assetManager->register($params['yiisoft/assets']['assetManager']['register']);
        return $assetManager;
    },
];
