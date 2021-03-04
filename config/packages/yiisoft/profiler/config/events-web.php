<?php

declare(strict_types=1);

use Yiisoft\Profiler\ProfilerInterface;
use Yiisoft\Yii\Web\Event\AfterEmit;

return [
    AfterEmit::class => [
        [ProfilerInterface::class, 'flush'],
    ],
];
