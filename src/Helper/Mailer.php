<?php

declare(strict_types=1);

namespace App\Helper;

use Yiisoft\Mailer\MailerInterface;

final class Mailer
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Message $contactMessage)
    {
        $message = $this->mailer->compose(
            'contact',
            [
                'name' => $contactMessage->getName(),
                'content' => $contactMessage->getContent(),
            ]
        )
        ->setSubject($contactMessage->getSubject())
        ->setFrom($contactMessage->getEmail())
        ->setTo($contactMessage->getTo());

        $files = $contactMessage->getFiles();

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
