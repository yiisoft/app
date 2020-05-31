<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

?>

<?= Html::beginTag('div', $layoutParameters->getNavBarOptions()) ?>

    <?= Html::beginTag('div', $layoutParameters->getNavBarBrandOptions()) ?>
        <?= Html::tag(
            'span',
            Html::img($layoutParameters->getLogo()),
            $layoutParameters->getNavBarBrandLogoOptions()
        ) ?>
        <?=  Html::a(
            $layoutParameters->getName(),
            $layoutParameters->getbrandUrl(),
            $layoutParameters->getNavBarBrandTitleOptions()
        ) ?>
    <?= Html::endTag('div') ?>

<?= Html::endTag('div');

