<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/* @var string $name */
/* @var string $content */
?>

<?= Html::encode($content) ?>

<p><?= Html::encode($name) ?></p>
