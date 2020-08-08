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
    private string $cachePath;

    public function __construct(string $cachePath = '@runtime/cache')
    {
        $this->cachePath = $cachePath;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(
            CacheInterface::class,
            fn (ContainerInterface $container) => new FileCache(
                $container->get(Aliases::class)->get($this->cachePath)
            )
        );

        $container->set(YiiCacheInterface::class, Cache::class);
    }
}
