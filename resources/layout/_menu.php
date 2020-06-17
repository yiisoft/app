<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/** @var \App\ApplicationParameters $applicationParameters */
?>
<div class="navbar">
    <div class="navbar-brand">
        <span class="navbar-item">
            <img src="/images/yii-logo.jpg" alt="<?= Html::encode($applicationParameters->getName()) ?>">
        </span>
        <a href="/" class="navbar-item has-text-light">
            <?= Html::encode($applicationParameters->getName()) ?>
        </a>
    </div>
</div>
