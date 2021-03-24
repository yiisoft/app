<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Storage\MemoryStorage;
use Yiisoft\Yii\Debug\Storage\StorageInterface;

return [
    StorageInterface::class => MemoryStorage::class,
];
