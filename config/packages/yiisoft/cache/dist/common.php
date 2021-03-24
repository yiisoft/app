<?php

declare(strict_types=1);

return [
    \Yiisoft\Cache\CacheInterface::class => \Yiisoft\Cache\Cache::class,
    \Psr\SimpleCache\CacheInterface::class => \Yiisoft\Cache\ArrayCache::class,
];
