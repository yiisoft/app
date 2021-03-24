<?php

declare(strict_types=1);

use Yiisoft\Middleware\Dispatcher\Event\AfterMiddleware;
use Yiisoft\Middleware\Dispatcher\Event\BeforeMiddleware;
use Yiisoft\Profiler\ProfilerInterface;
use Yiisoft\Yii\Debug\Collector\MiddlewareCollector;
use Yiisoft\Yii\Debug\Collector\RequestCollector;
use Yiisoft\Yii\Debug\Collector\WebAppInfoCollector;
use Yiisoft\Yii\Debug\Debugger;
use Yiisoft\Yii\Web\Event\AfterEmit;
use Yiisoft\Yii\Web\Event\AfterRequest;
use Yiisoft\Yii\Web\Event\ApplicationShutdown;
use Yiisoft\Yii\Web\Event\ApplicationStartup;
use Yiisoft\Yii\Web\Event\BeforeRequest;

if (!(bool)($params['yiisoft/yii-debug']['enabled'] ?? false)) {
    return [];
}

return [
    ApplicationStartup::class => [
        [WebAppInfoCollector::class, 'collect'],
    ],
    ApplicationShutdown::class => [
        [WebAppInfoCollector::class, 'collect'],
    ],
    BeforeRequest::class => [
        [Debugger::class, 'startup'],
        [WebAppInfoCollector::class, 'collect'],
        [RequestCollector::class, 'collect'],
    ],
    AfterRequest::class => [
        [WebAppInfoCollector::class, 'collect'],
        [RequestCollector::class, 'collect'],
    ],
    AfterEmit::class => [
        [ProfilerInterface::class, 'flush'],
        [WebAppInfoCollector::class, 'collect'],
        [Debugger::class, 'shutdown'],
    ],
    BeforeMiddleware::class => [
        [MiddlewareCollector::class, 'collect'],
    ],
    AfterMiddleware::class => [
        [MiddlewareCollector::class, 'collect'],
    ],
];
