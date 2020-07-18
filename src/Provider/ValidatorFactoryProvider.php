<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Validator\ValidatorFactory;
use Yiisoft\Validator\ValidatorFactoryInterface;

final class ValidatorFactoryProvider extends ServiceProvider
{
    /**
     * @suppress PhanAccessMethodProtected
     *
     * @param Container $container
     */
    public function register(Container $container): void
    {
        $container->set(ValidatorFactoryInterface::class, ValidatorFactory::class);
    }
}
