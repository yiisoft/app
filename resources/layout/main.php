<?php

declare(strict_types=1);

use App\Asset\AppAsset;
use Yiisoft\Html\Html;

/**
 * @var Yiisoft\View\WebView $this
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var \App\ApplicationParameters $applicationParameters
 * @var string $csrf
 * @var string $content
 */

$assetManager->register([
    AppAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Html::encode($applicationParameters->getLanguage()) ?>">
    <?= $this->render('_head', ['csrf' => $csrf]) ?>
    <?php $this->beginBody() ?>
        <body>
            <section class="hero is-fullheight is-light">
                <div class="hero-head has-background-black">
                    <?= $this->render('_menu') ?>
                </div>
                <div class="hero-body is-light">
                    <div class="container has-text-centered">
                        <?= $content ?>
                    </div>
                </div>
                <div class="hero-footer has-background-black">
                    <?= $this->render('_footer') ?>
                </div>
            </section>
        </body>

    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
