<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/**
 * @var \App\ApplicationParameters $applicationParameters
 * @var string $csrf
 */
?>
<head>
    <?= Html::tag('meta', '', ['charset' => $applicationParameters->getCharset()]) ?>
    <?= Html::tag('meta', '', ['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']) ?>
    <?= Html::tag('meta', '', ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']) ?>
    <?= Html::tag('meta', '', ['name' => 'csrf', 'content' => $csrf]) ?>
    <?= Html::tag('title', Html::encode($this->getTitle())) ?>

    <?php $this->head() ?>
</head>
