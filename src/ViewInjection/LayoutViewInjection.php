<?php

declare(strict_types=1);

namespace App\ViewInjection;

use App\ApplicationParameters;
use Yiisoft\Assets\AssetManager;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\LayoutParametersInjectionInterface;

final class LayoutViewInjection implements LayoutParametersInjectionInterface
{
    private ApplicationParameters $applicationParameters;
    private AssetManager $assetManager;
    private Locale $locale;
    private UrlGeneratorInterface $urlGenerator;
    private CurrentRoute $currentRoute;

    public function __construct(
        ApplicationParameters $applicationParameters,
        AssetManager $assetManager,
        Locale $locale,
        UrlGeneratorInterface $urlGenerator,
        CurrentRoute $currentRoute
    ) {
        $this->applicationParameters = $applicationParameters;
        $this->assetManager = $assetManager;
        $this->locale = $locale;
        $this->urlGenerator = $urlGenerator;
        $this->currentRoute = $currentRoute;
    }

    public function getLayoutParameters(): array
    {
        return [
            'applicationParameters' => $this->applicationParameters,
            'assetManager' => $this->assetManager,
            'locale' => $this->locale,
            'urlGenerator' => $this->urlGenerator,
            'currentRoute' => $this->currentRoute,
        ];
    }
}
