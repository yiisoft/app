<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiisoft\Yii\Debug\Debugger;
use Yiisoft\Yii\Debug\DebuggerIdGenerator;
use Yiisoft\Yii\Debug\Storage\StorageInterface;

if (!(bool)($params['yiisoft/yii-debug']['enabled'] ?? false)) {
    return [];
}

return [
    Debugger::class => static function (ContainerInterface $container) use ($params) {
        $params = $params['yiisoft/yii-debug'];
        return new Debugger(
            $container->get(DebuggerIdGenerator::class),
            $container->get(StorageInterface::class),
            array_map(
                static fn ($class) => $container->get($class),
                array_merge($params['collectors'], $params['collectors.console'] ?? [])
            )
        );
    },
];
