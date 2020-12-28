<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Nav;
use Yiisoft\Yii\Bulma\NavBar;

/* @var App\ApplicationParameters $applicationParameters */
/* @var Yiisoft\Router\UrlGeneratorInterface $url */
/* @var Yiisoft\Router\UrlMatcherInterface $urlMatcher */

$currentUrl = '';

if ($urlMatcher->getCurrentRoute() !== null) {
    $currentUrl = $url->generate($urlMatcher->getCurrentRoute()->getName());
}
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
        ->items([])
    ?>

<?= NavBar::end();

