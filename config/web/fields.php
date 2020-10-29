<?php

declare(strict_types=1);

use Yiisoft\Form\Widget\Field;

return [
    Field::class => fn () => Field::Widget($params['yiisoft/form']['fieldConfig'])
];
