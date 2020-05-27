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
    public function register(Container $container): void
    {
        //cache
        $container->set(CacheInterface::class, static function (ContainerInterface $container) {
            return new FileCache($container->get(Aliases::class)->get('@runtime/cache'));
        });

        $container->set(YiiCacheInterface::class, Cache::class);
    }
}
