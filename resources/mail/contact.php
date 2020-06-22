<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/* @var string $name */
/* @var string $content */
?>

<p>
    <?= Html::encode($content) ?>
</p>

<p><?= Html::encode($name) ?></p>
