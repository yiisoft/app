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
    private static string $cacheFile;

    public function __construct(string $cacheFile = '@runtime/cache')
    {
        self::$cacheFile = $cacheFile;
    }

    public function register(Container $container): void
    {
        $container->set(CacheInterface::class, static function (ContainerInterface $container) {
            $aliases = $container->get(Aliases::class);

            return new FileCache($aliases->get(self::$cacheFile));
        });

        $container->set(YiiCacheInterface::class, Cache::class);
    }
}
