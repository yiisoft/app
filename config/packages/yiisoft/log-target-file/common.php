<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Log\Logger;
use Yiisoft\Log\Target\File\FileRotator;
use Yiisoft\Log\Target\File\FileRotatorInterface;
use Yiisoft\Log\Target\File\FileTarget;

/* @var $params array */

return [
    LoggerInterface::class => static fn (FileTarget $fileTarget) => new Logger([$fileTarget]),

    FileRotatorInterface::class => [
        '__class' => FileRotator::class,
        '__construct()' => [
            $params['yiisoft/log-target-file']['fileRotator']['maxFileSize'],
            $params['yiisoft/log-target-file']['fileRotator']['maxFiles'],
            $params['yiisoft/log-target-file']['fileRotator']['fileMode'],
            $params['yiisoft/log-target-file']['fileRotator']['rotateByCopy'],
            $params['yiisoft/log-target-file']['fileRotator']['compressRotatedFiles'],
        ],
    ],

    FileTarget::class => static function (Aliases $aliases, FileRotatorInterface $fileRotator) use ($params) {
        $fileTarget = new FileTarget(
            $aliases->get($params['yiisoft/log-target-file']['fileTarget']['file']),
            $fileRotator,
            $params['yiisoft/log-target-file']['fileTarget']['dirMode'],
            $params['yiisoft/log-target-file']['fileTarget']['fileMode'],
        );

        $fileTarget->setLevels($params['yiisoft/log-target-file']['fileTarget']['levels']);

        return $fileTarget;
    },
];
