<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

$this->params['breadcrumbs'] = '/';

$this->setTitle($layoutParameters->getName());
?>

<?= Html::tag('h1', 'Hello World', ['class' => 'title']) ?>
<?= Html::tag('p', 'My first website with <strong>Yii 3.0</strong>!', ['class' => 'subtitle']);
