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

    <?= Html::beginTag('div', $layoutParameters->getHeroFooterColumnRigthOptions()) ?>
        <?= $layoutParameters->getHeroFooterColumnRigth() ?>
    <?= Html::endTag('div') ?>

<?= Html::tag('div');
