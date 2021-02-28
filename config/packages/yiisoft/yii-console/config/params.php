<?php

declare(strict_types=1);

use App\Command\Hello;
use Yiisoft\Yii\Console\Command\Serve;

return [
    'yiisoft/yii-console' => [
        'id' => 'yii-console',
        'name' => 'Yii Console',
        'autoExit' => false,
        'commands' => [
            'serve' => Serve::class,
            'hello' => Hello::class,
        ],
        'version' => '3.0',
    ],
];
