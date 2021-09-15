<?php

declare(strict_types=1);

namespace App\ViewInjection;

use Yiisoft\Assets\AssetManager;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\LayoutParametersInjectionInterface;

final class LayoutViewInjection implements LayoutParametersInjectionInterface
{
    private AssetManager $assetManager;
    private Locale $locale;
    private UrlGeneratorInterface $urlGenerator;
    private CurrentRoute $currentRoute;

    public function __construct(
        AssetManager $assetManager,
        Locale $locale,
        UrlGeneratorInterface $urlGenerator,
        CurrentRoute $currentRoute
    ) {
        $this->assetManager = $assetManager;
        $this->locale = $locale;
        $this->urlGenerator = $urlGenerator;
        $this->currentRoute = $currentRoute;
    }

    public function getLayoutParameters(): array
    {
        return [
            'assetManager' => $this->assetManager,
            'locale' => $this->locale,
            'urlGenerator' => $this->urlGenerator,
            'currentRoute' => $this->currentRoute,
        ];
    }
}
