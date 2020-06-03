<?php

declare(strict_types=1);

namespace App\Provider;

use App\LayoutParameters;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\View\Theme;
use Yiisoft\View\WebView;

final class WebViewProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->set(WebView::class, static function (ContainerInterface $container) {
            /** WebView config */
            $webView = new WebView(
                $container->get(Aliases::class)->get('@views'),
                $container->get(Theme::class),
                $container->get(EventDispatcherInterface::class),
                $container->get(LoggerInterface::class)
            );

            /**
             * Passes {@see Aliases} {@see AssetManager} {@see UrlGenerator} {@see UrlMatcher} {@see LayoutParameters}
             *
             * It will be available as $aliases, $assetManager, $urlGenerator, $urlMatcher, $layoutParameters in view
             * or layout.
             */
            $webView->setDefaultParameters(
                [
                    'aliases' => $container->get(Aliases::class),
                    'assetManager' => $container->get(AssetManager::class),
                    'urlGenerator' => $container->get(UrlGeneratorInterface::class),
                    'urlMatcher' => $container->get(UrlMatcherInterface::class),
                    'layoutParameters' => $container->get(LayoutParameters::class)
                ]
            );

            return $webView;
        });
    }
}
