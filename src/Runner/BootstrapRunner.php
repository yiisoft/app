<?php

declare(strict_types=1);

namespace App\Runner;

use Psr\Container\ContainerInterface;
use RuntimeException;

use function get_debug_type;
use function is_callable;

final class BootstrapRunner
{
    private ContainerInterface $container;
    private array $bootstrapList;

    public function __construct(ContainerInterface $container, array $bootstrapList = [])
    {
        $this->container = $container;
        $this->bootstrapList = $bootstrapList;
    }

    public function run(): void
    {
        foreach ($this->bootstrapList as $callback) {
            if (!(is_callable($callback))) {
                $type = get_debug_type($callback);
                throw new RuntimeException("Bootstrap callback must be callable, $type given.");
            }
            $callback($this->container);
        }
    }
}
