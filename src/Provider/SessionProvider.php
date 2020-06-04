<?php

declare(strict_types=1);

namespace App\Provider;

use App\ApplicationParameters;
use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Yii\Web\Session\Session;
use Yiisoft\Yii\Web\Session\SessionInterface;

final class SessionProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->set(SessionInterface::class, static function (ContainerInterface $container) {
            $applicationParameters = $container->get(ApplicationParameters::class);
            return new Session(
                $applicationParameters->getSessionOptions(),
                $applicationParameters->getSessionHandler()
            );
        });
    }
}
