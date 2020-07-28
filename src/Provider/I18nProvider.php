<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\I18n\TranslatorInterface;
use Yiisoft\I18n\Message\PhpFile;
use Yiisoft\I18n\Translator\Translator;

final class I18nProvider extends ServiceProvider
{
    private string $locale;
    private string $translatePath;

    public function __construct(string $locale, string $translatePath)
    {
        $this->locale = $locale;
        $this->translatePath = $translatePath;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(
            TranslatorInterface::class,
            function (ContainerInterface $container) {
                $aliases = $container->get(Aliases::class);

                $translator = new Translator(
                    $container->get(EventDispatcherInterface::class),
                    new PhpFile($aliases->get($this->translatePath)),
                    null
                );

                $translator->setDefaultLocale($this->locale);

                return $translator;
            }
        );
    }
}
