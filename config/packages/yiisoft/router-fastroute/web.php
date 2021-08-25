<?php

declare(strict_types=1);

use Yiisoft\Injector\Injector;
use Yiisoft\Router\FastRoute\UrlMatcher;
use Yiisoft\Router\UrlMatcherInterface;

/** @var array $params */

return [
    UrlMatcherInterface::class => static function (Injector $injector) use ($params) {
        $enableCache = $params['yiisoft/router-fastroute']['enableCache'] ?? true;

        $arguments = [];
        if ($enableCache === false) {
            $arguments['cache'] = null;
        }
        return $injector->make(UrlMatcher::class, $arguments);
    },
];
