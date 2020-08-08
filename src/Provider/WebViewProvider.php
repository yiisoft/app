<?php

declare(strict_types=1);

namespace App\Provider;

use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\View\Theme;
use Yiisoft\View\WebView;

final class WebViewProvider extends ServiceProvider
{
    private string $basePath;

    private array $defaultParameters;

    public function __construct(string $basePath, array $defaultParameters = [])
    {
        $this->basePath = $basePath;
        $this->defaultParameters = $defaultParameters;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(WebView::class, function (ContainerInterface $container) {
            $defaultParameters = [];
            $aliases = $container->get(Aliases::class);

            $webView = new WebView(
                $aliases->get($this->basePath),
                $container->get(Theme::class),
                $container->get(EventDispatcherInterface::class),
                $container->get(LoggerInterface::class)
            );

            foreach ($this->defaultParameters as $key => $value) {
                $defaultParameters[$key] = $container->get($value);
            }

            $webView->setDefaultParameters($defaultParameters);

            return $webView;
        });
    }
}
