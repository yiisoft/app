<?php

declare(strict_types=1);

use Yiisoft\Form\Widget\Field;

if ($params['yiisoft/form']['bulma']['enabled'] === true) {
    return [
        Field::class => fn () => Field::Widget($params['yiisoft/form']['bulma']['fieldConfig']),
    ];
}
