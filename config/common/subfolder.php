<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\Middleware\SubFolder;

return [
    SubFolder::class => static function (
        Aliases $aliases,
        UrlGeneratorInterface $urlGenerator
    ) use ($params) {
        $aliases->set('@baseUrl', $params['app']['prefix']);

        return new SubFolder(
            $urlGenerator,
            $aliases,
            $params['app']['prefix'] === '/' ? null : $params['app']['prefix'],
        );
    },
];
