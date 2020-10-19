<?php

declare(strict_types=1);

use App\ApplicationParameters;
use App\Contact\ContactMailer;
use App\Service\Mailer;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use Yiisoft\Cache\File\FileCache;

/* @var array $params */

return [
    ContactMailer::class => static function (ContainerInterface $container) use ($params) {
        return (new ContactMailer(
            $container->get(Mailer::class),
            $params['mailer']['adminEmail']
        ));
    },
    CacheInterface::class => FileCache::class,
    ApplicationParameters::class => static function () use ($params) {
        return (new ApplicationParameters())
            ->charset($params['app']['charset'])
            ->language($params['app']['language'])
            ->name($params['app']['name']);
    },
];
