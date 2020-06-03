<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/** @var \App\ApplicationParameters $applicationParameters */
?>
<?= Html::beginTag('div', $applicationParameters->getHeroFooterColumnOptions()) ?>

    <?= Html::beginTag('div', $applicationParameters->getHeroFooterColumnLeftOptions()) ?>
        <?= $applicationParameters->getHeroFooterColumnLeft() ?>
    <?= Html::endTag('div') ?>

    <?= Html::beginTag('div', $applicationParameters->getHeroFooterColumnCenterOptions()) ?>
        <?= $applicationParameters->getHeroFooterColumnCenter() ?>
    <?= Html::endTag('div') ?>

    <?= Html::beginTag('div', $applicationParameters->getHeroFooterColumnRightOptions()) ?>
        <?= $applicationParameters->getHeroFooterColumnRight() ?>
    <?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
