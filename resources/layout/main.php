<?php

declare(strict_types=1);

use App\Asset\AppAsset;
use Yiisoft\Html\Html;

/**
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
    <?= Html::beginTag('html', ['lang' => $applicationParameters->getLanguage()]) ?>

        <?= $this->render('_head', ['csrf' => $csrf]) ?>

        <?php $this->beginBody() ?>

            <body>
                <?= Html::beginTag('section', $applicationParameters->getHeroOptions()) ?>

                    <?= Html::beginTag('div', $applicationParameters->getHeroHeadOptions()) ?>
                        <?= $this->render('_menu') ?>
                    <?= Html::endTag('div') ?>

                    <?= Html::beginTag('div', $applicationParameters->getHeroBodyOptions()) ?>
                        <?= Html::beginTag('div', $applicationParameters->getHeroContainerOptions()) ?>
                            <?= $content ?>
                        <?= Html::endTag('div') ?>
                    <?= Html::endTag('div') ?>

                    <?= Html::beginTag('div', $applicationParameters->getHeroFooterOptions()) ?>
                        <?= $this->render('_footer') ?>
                    <?= Html::endTag('div') ?>

                <?= Html::endTag('section') ?>
            </body>

        <?php $this->endBody() ?>

    <?= Html::endTag('html') ?>

<?php $this->endPage() ?>
