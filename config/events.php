<?php

declare(strict_types=1);

use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use Yiisoft\Composer\Config\Buildtime;

return [
    ReverseBlockMerge::class => Buildtime::run(new ReverseBlockMerge()),
];
