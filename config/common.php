<?php

declare(strict_types=1);

use App\Service\Mailer;
use Psr\Container\ContainerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Mailer\MailerInterface;

/* @var array $params */

return [
    ContainerInterface::class => static function (ContainerInterface $container) {
        return $container;
    },

    Aliases::class => [
        '__class' => Aliases::class,
        '__construct()' => [$params['aliases']],
    ],

    Mailer::class => static function (ContainerInterface $container) use ($params) {
        return (new Mailer(
            $params['yiisoft/mailer']['emailTo'],
            $container->get(MailerInterface::class)
        ));
    },
];
