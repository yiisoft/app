<?php

declare(strict_types=1);

use Psr\Log\LogLevel;
use Yiisoft\Profiler\Target\FileTarget;
use Yiisoft\Profiler\Target\LogTarget;

return [
    'yiisoft/profiler' => [
        'targets' => [
            LogTarget::class => [
                'include' => [],
                'exclude' => [],
                'enabled' => true,
                'level' => LogLevel::DEBUG,
            ],
            FileTarget::class => [
                'include' => [],
                'exclude' => [],
                'enabled' => false,
                'requestBeginTime' => $_SERVER['REQUEST_TIME_FLOAT'],
                'filename' => '@runtime/profiling/{date}-{time}.txt',
                'directoryMode' => 0775,
            ],
        ],
    ],
];
