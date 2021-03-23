<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\ProxyServiceProvider;

if (!(bool)($params['yiisoft/yii-debug']['enabled'] ?? false)) {
    return [];
}

return [
    'yiisoft/yii-debug/Debugger' => ProxyServiceProvider::class,
];
