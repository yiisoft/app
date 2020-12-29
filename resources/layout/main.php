<?php

declare(strict_types=1);

use App\Asset\AppAsset;
use App\Asset\CdnFontAwesomeAsset;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;

/**
 * @var App\ApplicationParameters $applicationParameters
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var string $content
 * @var string|null $csrf
 * @var Locale $locale
 * @var Yiisoft\View\WebView $this
 * @var Yiisoft\Router\UrlMatcherInterface $urlMatcher
 */

$assetManager->register([
    AppAsset::class,
    CdnFontAwesomeAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
$this->setJsStrings($assetManager->getJsStrings());
$this->setJsVar($assetManager->getJsVar());
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Html::encode($locale->language()) ?>">
    <?= $this->render('_head', ['applicationParameters' => $applicationParameters]) ?>
    <?php $this->beginBody() ?>
        <body>
            <section class="hero is-fullheight is-light">
                <div class="hero-head has-background-black">
                    <?= $this->render(
                        '_menu',
                        ['applicationParameters' => $applicationParameters, 'urlMatcher' => $urlMatcher]
                    ) ?>
                </div>
                <div class="hero-body is-light">
                    <div class="container has-text-centered">
                        <?= $content ?>
                    </div>
                </div>
                <div class="hero-footer has-background-black">
                    <?= $this->render('_footer', ['applicationParameters' => $applicationParameters]) ?>
                </div>
            </section>
        </body>

    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
