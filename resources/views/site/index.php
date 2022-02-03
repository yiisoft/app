<?php

declare(strict_types=1);

/**
 * @var \Yiisoft\View\WebView $this
 * @var \App\ApplicationParameters $applicationParameters
 */

$this->setTitle($applicationParameters->getName());
?>

<div class="text-center">
    <h1>Hello!</h1>

    <p>Let's start something great with <strong>Yii3</strong>!</p>

    <p>
        <a href="https://github.com/yiisoft/docs/tree/master/guide/en" target="_blank" rel="noopener">
            <i>Don't forget to check the guide.</i>
        </a>
    </p>
</div>
