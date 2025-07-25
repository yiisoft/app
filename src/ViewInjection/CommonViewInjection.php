<?php

declare(strict_types=1);

namespace App\ViewInjection;

use App\ApplicationParameters;
use Yiisoft\Yii\View\Renderer\CommonParametersInjectionInterface;
use Yiisoft\Router\UrlGeneratorInterface;

final readonly class CommonViewInjection implements CommonParametersInjectionInterface
{
    public function __construct(
        private ApplicationParameters $applicationParameters,
        private UrlGeneratorInterface $urlGenerator,
    ) {}

    public function getCommonParameters(): array
    {
        return [
            'applicationParameters' => $this->applicationParameters,
            'urlGenerator' => $this->urlGenerator,
        ];
    }
}
