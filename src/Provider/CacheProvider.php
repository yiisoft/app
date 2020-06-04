<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Cache\Cache;
use Yiisoft\Cache\CacheInterface as YiiCacheInterface;
use Yiisoft\Cache\File\FileCache;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class CacheProvider extends ServiceProvider
{
    private static string $cachePath;

    public function __construct(string $cachePath = '@runtime/cache')
    {
        self::$cachePath = $cachePath;
    }

    public function register(Container $container): void
    {
        $container->set(CacheInterface::class, static function (ContainerInterface $container) {
            $aliases = $container->get(Aliases::class);

            return new FileCache($aliases->get(self::$cachePath));
        });

        $container->set(YiiCacheInterface::class, Cache::class);
    }
}
