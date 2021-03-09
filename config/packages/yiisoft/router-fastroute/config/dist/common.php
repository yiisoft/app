<?php

declare(strict_types=1);

use Yiisoft\Router\FastRoute\UrlGenerator;
use Yiisoft\Router\UrlGeneratorInterface;

return [
    UrlGeneratorInterface::class => [
        '__class' => UrlGenerator::class,
        'setEncodeRaw()' => [$params['yiisoft/router-fastroute']['encodeRaw']],
    ],
];
