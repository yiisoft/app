<?php

declare(strict_types=1);

use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Yiisoft\Yii\Console\ErrorListener;

return [
    ConsoleErrorEvent::class => [
        [ErrorListener::class, 'onError'],
    ],
];
