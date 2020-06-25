<?php

declare(strict_types=1);

use Yiisoft\Html\Html;

/* @var App\ApplicationParameters $applicationParameters */
/* @var Yiisoft\Router\UrlGeneratorInterface $url */
/* @var Yiisoft\Router\UrlMatcherInterface $urlMatcher */

$currentUrl = $url->generate($urlMatcher->getCurrentRoute()->getName());
?>

<nav id="w0-navbar" class="is-black navbar">
    <div class="container">
        <div class="navbar-brand">
            <span class="navbar-item">
                <img src="/images/yii-logo.jpg" alt=<?= Html::encode($applicationParameters->getName()) ?>>
            </span>
            <a class="navbar-item" href="/"><?= Html::encode($applicationParameters->getName()) ?></a>
            <span class="navbar-burger burger" data-target="navbarMenu">
                <span></span><span></span><span></span>
            </span>
        </div>
        <div id="w0-navbar-Menu" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item">
                    <a class=<?= $currentUrl === '/about' ? '"navbar-item is-active"' : '""' ?> href="/about">About</a>
                </div>
                <div class="navbar-item">
                    <a class=<?= $currentUrl === '/contact' ? '"navbar-item is-active"' : '""' ?> href="/contact">Contact</a>
                </div>
            </div>
        </div>
    </div>
</nav>
