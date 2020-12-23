<?php

declare(strict_types=1);

namespace App\Event;

use App\Contact\Event\MessageNotSent;
use Yiisoft\Session\Flash\FlashInterface;

final class HandleMessageNotSent
{
    public function addFlash(MessageNotSent $messageNotSent, FlashInterface $flash): void
    {
        $flash->add(
            'is-danger',
            [
                'header' => 'System mailer notification.',
                'body' => $messageNotSent->getErrorMessage(),
            ],
            true
        );
    }
}
