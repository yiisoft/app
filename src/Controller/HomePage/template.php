<?php

declare(strict_types=1);

use App\ApplicationParameters;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var TranslatorInterface $translator
 * @var ApplicationParameters $applicationParameters
 */

$this->setTitle($applicationParameters->name);
?>

<div class="text-center">
    <h1><?= $translator->translate('site.hello')?>!</h1>

    <p><?= $translator->translate('site.start_with')?>!</p>

    <p>
        <a href="https://github.com/yiisoft/docs/tree/master/guide/en" target="_blank" rel="noopener">
            <i><?= $translator->translate('site.guide_remind')?>.</i>
        </a>
    </p>
</div>
