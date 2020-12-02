<?php

declare(strict_types=1);

use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;

/* @var App\Contact\ContactForm $form */
/* @var Yiisoft\Router\UrlGeneratorInterface $url */
/* @var string|null $csrf */
/* @var Yiisoft\Form\Widget\Field $field */

$this->setTitle('contact');
?>

<div class="column is-4 is-offset-4">

    <p class="subtitle has-text-black">
        Please fill out the following to Contact.
    </p>

    <?= Form::widget()
        ->action($url->generate('contact/form'))
        ->options(
            [
                'id' => 'form-contact',
                'csrf' => $csrf,
                'enctype' => 'multipart/form-data',
            ]
        )
        ->begin() ?>

        <?= $field->config($form, 'username') ?>
        <?= $field->config($form, 'email') ?>
        <?= $field->config($form, 'subject') ?>
        <?= $field->config($form, 'body')
            ->textArea(['class' => 'form-control textarea', 'rows' => 2]) ?>
        <?= $field->config($form, 'attachFiles')
            ->inputCssClass('file-input')
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
            ->fileInput(
                ['type' => 'file', 'multiple' => 'multiple', 'name' => 'attachFiles[]'],
                true,
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

</div>
