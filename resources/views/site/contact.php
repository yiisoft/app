<?php

declare(strict_types=1);

use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;

?>

<?= Html::beginTag('div', ['class' => 'column is-4 is-offset-4']) ?>

    <?= Html::beginTag('p', ['class' => 'subtitle has-text-black']) ?>
        Please fill out the following to Contact.
    <?= Html::endTag('p') ?>

    <?= Form::begin()
        ->action($url->generate('site/contact'))
        ->options(
            [
                'id' => 'form-contact',
                'csrf' => $csrf,
                'enctype' => 'multipart/form-data',
            ]
        )
        ->start() ?>

        <?= $field->config($form, 'username', ['class' => 'field']) ?>
        <?= $field->config($form, 'email', ['class' => 'field']) ?>
        <?= $field->config($form, 'subject', ['class' => 'field']) ?>
        <?= $field->config($form, 'body', ['class' => 'field'])
            ->textArea(['class' => 'form-control textarea', 'rows' => 2]) ?>
        <?= $field->config($form, 'attachFiles')
            ->template(
                '<div class="file is-small is-link has-name">
                    <label class="file-label">
                        {input}
                        <span class="file-cta">
                            <span class="file-icon"><i class="fas fa-upload"></i></span>
                            <span class="file-label">Choose a file…</span>
                        </span>
                        <span class="file-name">Please select a file.</span>
                    </label>
                </div>'
            )
            ->input(
                '',
                ['class' => 'file-input', 'type' => 'file', 'multiple' => 'multiple', 'name' => 'attachFiles[]']
            ) ?>

        <?= Html::submitButton(
            'Send mail ' . html::tag('i', '', ['class' => 'fas fa-share', 'aria-hidden' => 'true']),
            [
                'class' => 'button is-block is-info is-fullwidth has-margin-top-15',
                'id' => 'contact-button',
                'tabindex' => '5'
            ]
        ) ?>

        <?= Form::end() ?>

    <?= Html::endTag('div') ?>

<?php echo Html::endTag('div');
