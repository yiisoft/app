<?php

declare(strict_types=1);

use App\Asset\AppAsset;
use App\Asset\CdnFontAwesomeAsset;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Yii\Bulma\Nav;
use Yiisoft\Yii\Bulma\NavBar;

/**
 * @var App\ApplicationParameters $applicationParameters
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var string $content
 * @var string|null $csrf
 * @var Locale $locale
 * @var Yiisoft\View\WebView $this
 * @var Yiisoft\Router\CurrentRoute $currentRoute
 */

$assetManager->register([
    AppAsset::class,
    CdnFontAwesomeAsset::class,
]);

$this->addCssFiles($assetManager->getCssFiles());
$this->addCssStrings($assetManager->getCssStrings());
$this->addJsFiles($assetManager->getJsFiles());
$this->addJsStrings($assetManager->getJsStrings());
$this->addJsVars($assetManager->getJsVars());
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Html::encode($locale->language()) ?>">
    <head>
        <meta charset="<?= Html::encode($applicationParameters->getCharset()) ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->getTitle()) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
            <section class="hero is-fullheight is-light">
                <div class="hero-head has-background-black">
                    <?= NavBar::widget()
                        ->brandLabel($applicationParameters->getName())
                        ->brandImage('/images/yii-logo.jpg')
                        ->options(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
                        ->itemsOptions(['class' => 'navbar-end'])
                        ->begin() ?>

                    <?= Nav::widget()
                        ->currentPath(
                            $currentRoute->getUri() !== null
                                ? $currentRoute->getUri()->getPath()
                                : ''
                        )
                        ->items([]) ?>

                    <?= NavBar::end() ?>
                </div>
                <div class="hero-body is-light">
                    <div class="container has-text-centered">
                        <?= $content ?>
                    </div>
                </div>
                <div class="hero-footer has-background-black">
                    <div class="columns is-mobile">
                        <div class="column has-text-left has-text-light">
                            <i class="fas fa-copyright fa-inverse is-hidden-mobile"></i>
                            <a class="is-hidden-mobile" href="https://www.yiiframework.com/" target="_blank" rel="noopener">
                                <?= date('Y') ?>  <?= Html::encode($applicationParameters->getName()) ?>
                            </a>
                            <a class="is-hidden-desktop is-size-6" href="https://www.yiiframework.com/" target="_blank" rel="noopener">
                                <?= Html::encode($applicationParameters->getName()) ?>
                            </a>
                        </div>
                        <div class="column has-text-centered has-text-light is-hidden-mobile"></div>
                        <div class="column has-text-right has-text-light">
                            <span class="icon">
                                <a href="https://github.com/yiisoft" target="_blank" rel="noopener">
                                    <i class="fab fa-github fa-inverse" aria-hidden="true"></i>
                                </a>
                            </span>
                            <span class="icon">
                                <a href="https://join.slack.com/t/yii/shared_invite/enQtMzQ4MDExMDcyNTk2LTc0NDQ2ZTZhNjkzZDgwYjE4YjZlNGQxZjFmZDBjZTU3NjViMDE4ZTMxNDRkZjVlNmM1ZTA1ODVmZGUwY2U3NDA" target="_blank" rel="noopener">
                                    <i class="fab fa-slack fa-inverse " aria-hidden="true"></i>
                                </a>
                            </span>
                            <span class="icon">
                                <a href="https://www.facebook.com/groups/yiitalk" target="_blank" rel="noopener">
                                    <i class="fab fa-facebook-f fa-inverse" aria-hidden="true"></i>
                                </a>
                            </span>
                            <span class="icon">
                                <a href="https://twitter.com/yiiframework" target="_blank" rel="noopener">
                                    <i class="fab fa-twitter fa-inverse" aria-hidden="true"></i>
                                </a>
                            </span>
                            <span class="icon">
                                <a href="https://t.me/yii3ru" target="_blank" rel="noopener">
                                    <i class="fab fa-telegram-plane fa-inverse"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
