<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;
use Yiisoft\Injector\Injector;

final class BootstrapHandler
{
    private ContainerInterface $container;
    private array $callbacks;

    public function __construct(ContainerInterface $container, array $callbacks = [])
    {
        $this->container = $container;
        $this->callbacks = $callbacks;
    }

    public function execute(): void
    {
        $injector = new Injector($this->container);
        foreach ($this->callbacks as $callback) {
            $injector->invoke($callback);
        }
    }
}
