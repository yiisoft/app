<?php

declare(strict_types=1);

use App\Contact\Event\MessageSent;
use App\Contact\Event\MessageNotSent;
use App\Event\HandleMessageNotSent;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;

return [
    MessageSent::class => [[MessageSent::class, 'addFlash']],
    MessageNotSent::class => [[HandleMessageNotSent::class, 'addFlash']],
    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
