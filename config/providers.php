<?php

declare(strict_types=1);

/* @var array $params */

use App\Provider\RouterProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use Yiisoft\Composer\Config\Builder;

return [
    'yiisoft/router-fastroute/router' => [
        '__class' => RouterProvider::class,
        '__construct()' => [Builder::require('routes')],
    ],
    'yiisoft/log-target-file/filerotator' => [
        '__class' => FileRotatorProvider::class,
        '__construct()' => [
            $params['yiisoft/log-target-file']['file-rotator']['maxfilesize'],
            $params['yiisoft/log-target-file']['file-rotator']['maxfiles'],
            $params['yiisoft/log-target-file']['file-rotator']['filemode'],
            $params['yiisoft/log-target-file']['file-rotator']['rotatebycopy']
        ],
    ],
    ReverseBlockMerge::class => new ReverseBlockMerge()
];
