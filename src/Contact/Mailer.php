<?php

declare(strict_types=1);

namespace App\Contact;

use Yiisoft\Mailer\MailerInterface;

class Mailer
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Message $emailMessage): void
    {
        $message = $this->mailer->compose(
            'contact',
            [
                'name' => $emailMessage->getName(),
                'content' => $emailMessage->getContent(),
            ]
        )
            ->setSubject($emailMessage->getSubject())
            ->setFrom($emailMessage->getEmail())
            ->setTo($emailMessage->getTo());

        $files = $emailMessage->getFiles();

        foreach ($files as $file) {
            $message->attachContent(
                (string)$file->getStream(),
                [
                    'fileName' => $file->getClientFilename(),
                    'contentType' => $file->getClientMediaType(),
                ]
            );
        }

        $message->send();
    }
}
