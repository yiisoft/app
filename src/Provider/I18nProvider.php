<?php

declare(strict_types=1);

namespace App\Provider;

use App\ApplicationParameters;
use App\Service\MessageTranslator;
use App\Service\Parameters;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\I18n\TranslatorInterface;
use Yiisoft\I18n\Translator\Translator;

final class I18nProvider extends ServiceProvider
{
    /**
     * @suppress PhanAccessMethodProtected
     *
     * @param Container $container
     */
    public function register(Container $container): void
    {
        $container->set(
            TranslatorInterface::class,
            function (ContainerInterface $container) {
                $app = $container->get(ApplicationParameters::class);

                $translator = new Translator(
                    $container->get(EventDispatcherInterface::class),
                    new MessageTranslator([]),
                    null
                );

                $translator->setDefaultLocale($app->getLocale());

                return $translator;
            }
        );
    }
}
