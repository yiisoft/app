<?php

declare(strict_types=1);

use Yiisoft\EventDispatcher\Provider\ListenerCollection;
use Yiisoft\Yii\Event\ListenerCollectionFactory as Factory;

/** @var \Yiisoft\Config\Config $config */

return [
    ListenerCollection::class => static fn (Factory $factory) => $factory->create($config->get('events-console')),
];
