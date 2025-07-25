<?php

declare(strict_types=1);

namespace App\ViewInjection;

use App\ApplicationParams;
use Yiisoft\Yii\View\Renderer\CommonParametersInjectionInterface;
use Yiisoft\Router\UrlGeneratorInterface;

final readonly class CommonViewInjection implements CommonParametersInjectionInterface
{
    public function __construct(
        private ApplicationParams $applicationParams,
        private UrlGeneratorInterface $urlGenerator,
    ) {}

    public function getCommonParameters(): array
    {
        return [
            'applicationParams' => $this->applicationParams,
            'urlGenerator' => $this->urlGenerator,
        ];
    }
}
