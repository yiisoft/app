<?php

declare(strict_types=1);

namespace App\ViewInjection;

use App\ApplicationParameters;
use Yiisoft\Yii\View\ContentParametersInjectionInterface;

final class ContentViewInjection implements ContentParametersInjectionInterface
{
    private ApplicationParameters $applicationParameters;

    public function __construct(
        ApplicationParameters $applicationParameters
    ) {
        $this->applicationParameters = $applicationParameters;
    }

    public function getContentParameters(): array
    {
        return [
            'applicationParameters' => $this->applicationParameters,
        ];
    }
}
