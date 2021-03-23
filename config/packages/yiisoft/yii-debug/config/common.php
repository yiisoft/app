<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Container\Proxy\ContainerProxyInterface;
use Yiisoft\Yii\Debug\Collector\EventCollector;
use Yiisoft\Yii\Debug\Collector\EventCollectorInterface;
use Yiisoft\Yii\Debug\Collector\LogCollector;
use Yiisoft\Yii\Debug\Collector\LogCollectorInterface;
use Yiisoft\Yii\Debug\Collector\RouterCollector;
use Yiisoft\Yii\Debug\Collector\RouterCollectorInterface;
use Yiisoft\Yii\Debug\Collector\ServiceCollector;
use Yiisoft\Yii\Debug\Collector\ServiceCollectorInterface;
use Yiisoft\Yii\Debug\DebuggerIdGenerator;
use Yiisoft\Yii\Debug\Proxy\ContainerProxy;
use Yiisoft\Yii\Debug\Proxy\ContainerProxyConfig;
use Yiisoft\Yii\Debug\Storage\FileStorage;
use Yiisoft\Yii\Debug\Storage\StorageInterface;
use Yiisoft\Yii\Filesystem\FilesystemInterface;

/**
 * @var $params array
 */

$common = [
    StorageInterface::class => static function (ContainerInterface $container) use ($params) {
        $params = $params['yiisoft/yii-debug'];
        $filesystem = $container->get(FilesystemInterface::class);
        $debuggerIdGenerator = $container->get(DebuggerIdGenerator::class);
        $aliases = $container->get(Aliases::class);
        $fileStorage = new FileStorage($params['path'], $filesystem, $debuggerIdGenerator, $aliases);
        if (isset($params['historySize'])) {
            $fileStorage->setHistorySize((int)$params['historySize']);
        }
        return $fileStorage;
    },
];

if (!(bool)($params['yiisoft/yii-debug']['enabled'] ?? false)) {
    return $common;
}

return array_merge([
    LogCollectorInterface::class => LogCollector::class,
    EventCollectorInterface::class => EventCollector::class,
    RouterCollectorInterface::class => RouterCollector::class,
    ServiceCollectorInterface::class => ServiceCollector::class,
    ContainerProxyInterface::class => ContainerProxy::class,
    ContainerProxyConfig::class => static function (ContainerInterface $container) use ($params) {
        $params = $params['yiisoft/yii-debug'];
        $collector = $container->get(ServiceCollectorInterface::class);
        $dispatcher = $container->get(EventDispatcherInterface::class);
        $debuggerEnabled = (bool)($params['enabled'] ?? false);
        $trackedServices = (array)($params['trackedServices'] ?? []);
        $path = $container->get(Aliases::class)->get('@runtime/cache/container-proxy');
        $logLevel = $params['logLevel'] ?? 0;
        return new ContainerProxyConfig(
            $debuggerEnabled,
            $trackedServices,
            $dispatcher,
            $collector,
            $path,
            $logLevel
        );
    },
], $common);
