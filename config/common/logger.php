<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Yiisoft\Log\Logger;
use Yiisoft\Log\Target\Db\DbTarget;

return [
    LoggerInterface::class => static fn (DbTarget $dbTarget) => new Logger([$dbTarget]),
];
