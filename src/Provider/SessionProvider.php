<?php

declare(strict_types=1);

namespace App\Provider;

use SessionHandlerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Yii\Web\Session\Session;
use Yiisoft\Yii\Web\Session\SessionInterface;

final class SessionProvider extends ServiceProvider
{
    private static array $sessionOptions;
    private static ?SessionHandlerInterface $sessionHandler;

    public function __construct(
        array $sessionOptions = [['cookie_secure' => 0]],
        ?SessionHandlerInterface $sessionHandler = null
    ) {
        self::$sessionOptions = $sessionOptions;
        self::$sessionHandler = $sessionHandler;
    }

    public function register(Container $container): void
    {
        $container->set(SessionInterface::class, static function () {

            return new Session(self::$sessionOptions, self::$sessionHandler);
        });
    }
}
