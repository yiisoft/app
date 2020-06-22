<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class SwiftTransportProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->set(\Swift_Transport::class, \Swift_SmtpTransport::class);
    }
}
