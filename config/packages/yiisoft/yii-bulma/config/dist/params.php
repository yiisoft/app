<?php

declare(strict_types=1);

return [
    'yiisoft/form' => [
        'bulma' => [
            'enabled' => true,
            'fieldConfig' => [
                'inputCssClass()' => ['input field mb-1'],
                'labelOptions()' => [['label' => '']],
                'errorOptions()' => [['class' => 'help is-danger has-text-left is-italic mt-0 mb-2']],
                'errorCssClass()' => ['is-danger'],
                'successCssClass()' => ['is-success'],
            ],
        ],
    ],
];
