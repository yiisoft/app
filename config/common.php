<?php

declare(strict_types=1);

use App\Contact\ContactMailer;
use App\Service\Mailer;
use Psr\Container\ContainerInterface;
use Yiisoft\Aliases\Aliases;

/* @var array $params */

return [
    ContainerInterface::class => static function (ContainerInterface $container) {
        return $container;
    },

    Aliases::class => [
        '__class' => Aliases::class,
        '__construct()' => [$params['aliases']],
    ],

    ContactMailer::class => static function (ContainerInterface $container) use ($params) {
        return (new ContactMailer(
            $container->get(Mailer::class),
            $params['mailer']['adminEmail']
        ));
    },
];
