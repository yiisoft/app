<?php

declare(strict_types=1);

use App\Widget\PerformanceMetrics;
use Yiisoft\Html\Html;

?>

<?= Html::beginTag('footer', ['class' => 'footer']) ?>

    <?= Html::beginTag('div', ['class' => 'left margin-right-auto', 'style' => 'color: black']) ?>
        <?= PerformanceMetrics::widget() ?>
    <?= Html::endTag('div') ?>

    <?= Html::beginTag('div', ['class' => 'right', 'style' => 'align-content: flex-end']) ?>
        <a href="https://yiiframework.com"><strong>Copyright © 2020. YiiFramework</a>
    <?= Html::endTag('div') ?>

<?= Html::tag('footer');
