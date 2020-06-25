<?php

declare(strict_types=1);

namespace App\Service;

use Yiisoft\Form\FormModelInterface;
use Yiisoft\Mailer\MailerInterface;

final class Mailer
{
    private MailerInterface $mailer;
    private string $emailTo;

    public function __construct(string $emailTo, MailerInterface $mailer)
    {
        $this->emailTo = $emailTo;
        $this->mailer = $mailer;
    }

    public function message(FormModelInterface $form): Message
    {
        return new Message(
            $form->getAttributeValue('username'),
            $form->getAttributeValue('email'),
            $form->getAttributeValue('subject'),
            $form->getAttributeValue('body'),
            $this->emailTo,
        );
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
