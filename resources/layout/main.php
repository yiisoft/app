<?php

declare(strict_types=1);

use App\Asset\AppAsset;
use Yiisoft\Html\Html;

/**
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var \App\LayoutParameters $layoutParameters
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
    <?= Html::beginTag('html', ['lang' => $layoutParameters->getLanguage()]) ?>

        <?= $this->render('_head', ['csrf' => $csrf]) ?>

        <?php $this->beginBody() ?>

            <body>
                <?= Html::beginTag('section', $layoutParameters->getHeroOptions()) ?>

                    <?= Html::beginTag('div', $layoutParameters->getHeroHeadOptions()) ?>
                        <?= $this->render('_menu') ?>
                    <?= Html::endTag('div') ?>

                    <?= Html::beginTag('div', $layoutParameters->getHeroBodyOptions()) ?>
                        <?= Html::beginTag('div', $layoutParameters->getHeroContainerOptions()) ?>
                            <?= $content ?>
                        <?= Html::endTag('div') ?>
                    <?= Html::endTag('div') ?>

                    <?= Html::beginTag('div', $layoutParameters->getHeroFooterOptions()) ?>
                        <?= $this->render('_footer') ?>
                    <?= Html::endTag('div') ?>

                <?= Html::endTag('section') ?>
            </body>

        <?php $this->endBody() ?>

    <?= Html::endTag('html') ?>

<?php $this->endPage() ?>
