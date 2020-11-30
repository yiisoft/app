<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Nav;
use Yiisoft\Yii\Bulma\NavBar;

/* @var App\ApplicationParameters $applicationParameters */
/* @var Yiisoft\Router\UrlGeneratorInterface $url */
/* @var Yiisoft\Router\UrlMatcherInterface $urlMatcher */

$currentUrl = $url->generate($urlMatcher->getCurrentRoute()->getName());
?>

<?= NavBar::widget()
    ->brandLabel($applicationParameters->getName())
    ->brandImage('/images/yii-logo.jpg')
    ->options(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
    ->itemsOptions(['class' => 'navbar-end'])
    ->begin();
?>

    <?= Nav::widget()
        ->currentPath($currentUrl)
        ->items([
            ['label' => 'About', 'url' => $url->generate('site/about')],
            ['label' => 'Contact', 'url' => $url->generate('contact/form')],
        ]) ?>

<?= NavBar::end();

