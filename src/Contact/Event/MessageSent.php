<?php

declare(strict_types=1);

namespace App\Contact\Event;

use Yiisoft\Session\Flash\FlashInterface;

/**
 * @codeCoverageIgnore
 */
final class MessageSent
{
    public function addFlash(FlashInterface $flash): void
    {
        $flash->add(
            'is-success',
            [
                'header' => 'System mailer notification.',
                'body' => 'Thanks to contact us, we\'ll get in touch with you as soon as possible.',
            ],
            true
        );
    }
}
