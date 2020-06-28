<?php

namespace App\Service;

use Yiisoft\Mailer\MailerInterface;

class Mailer
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Message $emailMessage)
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
