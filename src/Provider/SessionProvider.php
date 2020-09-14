<?php

declare(strict_types=1);

namespace App\Provider;

use SessionHandlerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Session\Session;
use Yiisoft\Session\SessionInterface;

final class SessionProvider extends ServiceProvider
{
    private array $sessionOptions;
    private ?SessionHandlerInterface $sessionHandler;

    public function __construct(
        array $sessionOptions = [['cookie_secure' => 0]],
        ?SessionHandlerInterface $sessionHandler = null
    ) {
        $this->sessionOptions = $sessionOptions;
        $this->sessionHandler = $sessionHandler;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(
            SessionInterface::class,
            fn () => new Session($this->sessionOptions, $this->sessionHandler)
        );
    }
}
