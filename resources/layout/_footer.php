<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/** @var \App\LayoutParameters $layoutParameters */
?>
<?= Html::beginTag('div', $layoutParameters->getHeroFooterColumnOptions()) ?>

    <?= Html::beginTag('div', $layoutParameters->getHeroFooterColumnLeftOptions()) ?>
        <?= $layoutParameters->getHeroFooterColumnLeft() ?>
    <?= Html::endTag('div') ?>

    <?= Html::beginTag('div', $layoutParameters->getHeroFooterColumnCenterOptions()) ?>
        <?= $layoutParameters->getHeroFooterColumnCenter() ?>
    <?= Html::endTag('div') ?>

    <?= Html::beginTag('div', $layoutParameters->getHeroFooterColumnRightOptions()) ?>
        <?= $layoutParameters->getHeroFooterColumnRight() ?>
    <?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
