<?php

declare(strict_types=1);

use Yiisoft\Session\Flash\Flash;
use Yiisoft\Session\Flash\FlashInterface;
use Yiisoft\Session\Session;
use Yiisoft\Session\SessionInterface;

/* @var $params array */

return [
    SessionInterface::class => [
        '__class' => Session::class,
        '__construct()' => [
            $params['yiisoft/session']['session']['options'],
            $params['yiisoft/session']['session']['handler'],
        ],
    ],
    FlashInterface::class => Flash::class,
];
