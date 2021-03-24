<?php

declare(strict_types=1);

return [
    'yiisoft/aliases' => [
        'aliases' => [
            // @root needs to be redefined in the application config
            '@root' => dirname(__DIR__),
            '@vendor' => '@root/vendor',
            '@public' => '@root/public',
            '@runtime' => '@root/runtime',
            '@bower' => '@vendor/bower-asset',
            '@npm' => '@root/node_modules',
            '@baseUrl' => '/',
        ],
    ],
];
