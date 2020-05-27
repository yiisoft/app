<?php

declare(strict_types=1);

return [
    'aliases' => [
        '@root' => dirname(__DIR__),
        '@public' => '@root/public',
        '@images' => '@public/images',
        '@resources' => '@root/resources',
        '@basePath' => '@public/assets',
        '@web' => '/assets',
        '@npm' => '@root/node_modules',
        '@layout' => '@root/resources/layout',
        '@views' => '@root/resources/views',
        '@src' => '@root/src',
    ],

    'debugger.enabled' => true,

    'session' => [
        'options' => ['cookie_secure' => 0],
    ],

];
