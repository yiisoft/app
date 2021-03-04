<?php

declare(strict_types=1);

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Cache\CacheInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Yii\Debug\Collector\CommandCollector;
use Yiisoft\Yii\Debug\Collector\ConsoleAppInfoCollector;
use Yiisoft\Yii\Debug\Collector\EventCollectorInterface;
use Yiisoft\Yii\Debug\Collector\LogCollectorInterface;
use Yiisoft\Yii\Debug\Collector\MiddlewareCollector;
use Yiisoft\Yii\Debug\Collector\RequestCollector;
use Yiisoft\Yii\Debug\Collector\RouterCollector;
use Yiisoft\Yii\Debug\Collector\RouterCollectorInterface;
use Yiisoft\Yii\Debug\Collector\ServiceCollectorInterface;
use Yiisoft\Yii\Debug\Collector\WebAppInfoCollector;
use Yiisoft\Yii\Debug\Command\ResetCommand;
use Yiisoft\Yii\Debug\Proxy\ContainerProxy;
use Yiisoft\Yii\Debug\Proxy\EventDispatcherInterfaceProxy;
use Yiisoft\Yii\Debug\Proxy\LoggerInterfaceProxy;
use Yiisoft\Yii\Debug\Proxy\UrlMatcherInterfaceProxy;

/**
 * @var $params array
 */

return [
    'yiisoft/yii-debug' => [
        'enabled' => true,
        'collectors' => [
            LogCollectorInterface::class,
            EventCollectorInterface::class,
            ServiceCollectorInterface::class,
        ],
        'collectors.web' => [
            WebAppInfoCollector::class,
            RequestCollector::class,
            RouterCollector::class,
            MiddlewareCollector::class,
        ],
        'collectors.console' => [
            ConsoleAppInfoCollector::class,
            CommandCollector::class,
        ],
        'trackedServices' => [
            LoggerInterface::class => [LoggerInterfaceProxy::class, LogCollectorInterface::class],
            EventDispatcherInterface::class => [EventDispatcherInterfaceProxy::class, EventCollectorInterface::class],
            UrlMatcherInterface::class => [UrlMatcherInterfaceProxy::class, RouterCollectorInterface::class],
            CacheInterface::class,
        ],
        'logLevel' => ContainerProxy::LOG_ARGUMENTS | ContainerProxy::LOG_RESULT | ContainerProxy::LOG_ERROR,
        'path' => '@runtime/debug',
        'optionalRequests' => [
            '/assets/*',
        ],
    ],
    'yiisoft/yii-console' => [
        'commands' => [
            'debug/reset' => ResetCommand::class,
        ],
    ],
];
