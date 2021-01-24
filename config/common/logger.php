<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Yiisoft\Log\Logger;
use Yiisoft\Log\Target\File\FileTarget;

return [
    LoggerInterface::class => static fn (FileTarget $fileTarget) => new Logger([$fileTarget]),
];
