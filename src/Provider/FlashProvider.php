<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Session\Flash\Flash;
use Yiisoft\Session\SessionInterface;

final class FlashProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        /**
         * @psalm-suppress InaccessibleMethod
         */
        $container->set(
            Flash::class,
            static fn (ContainerInterface $container) => new Flash($container->get(SessionInterface::class))
        );
    }
}
