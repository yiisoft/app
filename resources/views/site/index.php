<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

$this->params['breadcrumbs'] = '/';

$this->setTitle('My Project Basic');
?>

<?= Html::beginTag('div', ['class' => 'box']) ?>
    <?= Html::beginTag('div') ?>
        <?= Html::tag('h1', 'Hello World') ?>
    <?= Html::endTag('div') ?>
    <?= Html::tag('div', 'My first website with <strong>Yii 3.0</strong>!'); ?>
<?= Html::endTag('div');
