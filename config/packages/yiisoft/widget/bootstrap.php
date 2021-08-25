<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiisoft\Widget\WidgetFactory;

return [
    static function (ContainerInterface $container) {
        WidgetFactory::initialize($container);
    },
];
