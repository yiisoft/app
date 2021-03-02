<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Profiler\Profiler;
use Yiisoft\Profiler\ProfilerInterface;
use Yiisoft\Profiler\Target\FileTarget;
use Yiisoft\Profiler\Target\LogTarget;

/**
 * @var array $params
 */
return [
    ProfilerInterface::class => static function (ContainerInterface $container, LoggerInterface $logger) use ($params) {
        $params = $params['yiisoft/profiler'];
        $targets = [];
        foreach ($params['targets'] as $target => $targetParams) {
            $targets[] = $container->get($target);
        }
        return new Profiler($logger, $targets);
    },
    LogTarget::class => static function (LoggerInterface $logger) use ($params) {
        $params = $params['yiisoft/profiler']['targets'][LogTarget::class];
        $target = new LogTarget($logger, $params['level']);

        if ((bool)$params['enabled']) {
            $target = $target->enable();
        } else {
            $target = $target->disable();
        }
        return $target->include($params['include'])->exclude($params['exclude']);
    },
    FileTarget::class => static function (Aliases $aliases) use ($params) {
        $params = $params['yiisoft/profiler']['targets'][FileTarget::class];
        $target = new FileTarget($aliases->get($params['filename']), $params['directoryMode']);

        if ((bool)$params['enabled']) {
            $target = $target->enable();
        } else {
            $target = $target->disable();
        }
        return $target->include($params['include'])->exclude($params['exclude']);
    },
];
