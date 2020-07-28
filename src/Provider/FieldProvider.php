<?php

declare(strict_types=1);

namespace App\Provider;

use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Form\Widget\Field;

final class FieldProvider extends ServiceProvider
{
    private array $fieldConfig;

    public function __construct(array $fieldConfig = [])
    {
        $this->fieldConfig = $fieldConfig;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(Field::class, fn () => Field::widget($this->fieldConfig));
    }
}
