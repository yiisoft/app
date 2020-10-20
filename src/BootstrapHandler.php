<?php

declare(strict_types=1);

namespace App;

use Yiisoft\Injector\Injector;

final class BootstrapHandler
{
    private Injector $injector;
    private array $callbacks;

    public function __construct(Injector $injector, array $callbacks = [])
    {
        $this->injector = $injector;
        $this->callbacks = $callbacks;
    }

    public function execute(): void
    {
        foreach ($this->callbacks as $callback) {
            $this->injector->invoke($callback);
        }
    }
}
