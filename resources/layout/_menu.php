<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/** @var \App\ApplicationParameters $applicationParameters */
?>
<?= Html::beginTag('div', $applicationParameters->getNavBarOptions()) ?>
    <?= Html::beginTag('div', $applicationParameters->getNavBarBrandOptions()) ?>
        <?= Html::tag(
            'span',
            Html::img($applicationParameters->getLogo()),
            $applicationParameters->getNavBarBrandLogoOptions()
        ) ?>
        <?=  Html::a(
            $applicationParameters->getName(),
            $applicationParameters->getBrandUrl(),
            $applicationParameters->getNavBarBrandTitleOptions()
        ) ?>
    <?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
