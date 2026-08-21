<?php

declare(strict_types=1);

use App\Shared\ApplicationParams;
use Yiisoft\View\WebView;

/**
 * @var WebView $this
 * @var ApplicationParams $applicationParams
 */

$this->setTitle($applicationParams->name);
?>

<div class="text-center">
    <h1>Hello!</h1>

    <p>Let's start something great with <strong>Yii3</strong>!</p>

    <!-- Vanilla JS + Yii3 co-work demo -->
    <div id="yii3-vanilla-box" class="yii3-vanilla">
        <p>Backend status: <span id="yii3-status" class="yii3-badge">loading...</span></p>
        <p>Server time: <span id="yii3-time"></span></p>
        <button id="yii3-refresh" type="button">Refresh from Yii3 API</button>
    </div>

    <p>
        <a href="https://yiisoft.github.io/docs/" target="_blank" rel="noopener">
            <i>Don't forget to check the guide.</i>
        </a>
    </p>
</div>
