<?php

declare(strict_types=1);

namespace App\Provider;

use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class SwiftSmtpTransportProvider extends ServiceProvider
{
    private string $host;
    private int $port;
    private ?string $encryption;
    private string $username;
    private string $password;

    public function __construct(string $host, int $port, ?string $encryption, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->encryption = $encryption;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(\Swift_Transport::class, function () {
            $swiftSmtpTransport = new \Swift_SmtpTransport(
                $this->host,
                $this->port,
                $this->encryption
            );

            $swiftSmtpTransport->setUsername($this->username);
            $swiftSmtpTransport->setPassword($this->password);

            return $swiftSmtpTransport;
        });
    }
}
