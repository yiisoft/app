<?php

use App\EventHandler\SetLocaleEventHandler;
use Yiisoft\Yii\Middleware\Event\SetLocaleEvent;

return [
    SetLocaleEvent::class => [[SetLocaleEventHandler::class, 'handle']]
];
