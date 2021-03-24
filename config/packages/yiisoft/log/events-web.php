<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Yiisoft\Log\Logger;
use Yiisoft\Yii\Web\Event\AfterEmit;

return [
    AfterEmit::class => [
        static function (LoggerInterface $logger): void {
            if ($logger instanceof Logger) {
                $logger->flush(true);
            }
        },
    ],
];
