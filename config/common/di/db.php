<?php

declare(strict_types=1);

use Psr\SimpleCache\CacheInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Db\Cache\SchemaCache;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Profiler\ProfilerInterface as DatabaseProfilerInterface;
use Yiisoft\Db\Sqlite\Connection;
use Yiisoft\Db\Sqlite\Driver;

return [
    ConnectionInterface::class => static function (
        Aliases $aliases,
        CacheInterface $cache,
        ?DatabaseProfilerInterface $profiler = null,
    ): ConnectionInterface {
        $connection = new Connection(
            new Driver('sqlite:' . $aliases->get('@runtime') . '/app.sq3'),
            new SchemaCache($cache),
        );

        // A profiler is only bound in environments that enable one, which is how the debugger records every query.
        $connection->setProfiler($profiler);

        return $connection;
    },
];
