<?php

declare(strict_types=1);

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Yiisoft\Yii\Filesystem\FileStorageConfigs;
use Yiisoft\Yii\Filesystem\Filesystem;
use Yiisoft\Yii\Filesystem\FilesystemInterface;

/**
 * @var array $params
 */

return [
    FilesystemInterface::class => static function () use ($params) {
        $aliases = $params['yiisoft/aliases']['aliases'] ?? [];
        if (!isset($aliases['@root'])) {
            throw new \RuntimeException('Alias of the root directory is not defined.');
        }

        $adapter = new LocalFilesystemAdapter(
            $aliases['@root'],
            PortableVisibilityConverter::fromArray([
                'file' => [
                    'public' => 0644,
                    'private' => 0600,
                ],
                'dir' => [
                    'public' => 0755,
                    'private' => 0700,
                ],
            ]),
            LOCK_EX,
            LocalFilesystemAdapter::DISALLOW_LINKS
        );

        return new Filesystem($adapter, $aliases);
    },
    FileStorageConfigs::class => static fn () => new FileStorageConfigs($params['file.storage'] ?? []),
];
