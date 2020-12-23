<?php

declare(strict_types=1);

namespace App\Contact;

use Exception;
use App\Contact\Event\MessageSent;
use App\Contact\Event\MessageNotSent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Mailer\MailerInterface;

final class Mailer
{
    private EventDispatcherInterface $dispatch;
    private LoggerInterface $logger;
    private MailerInterface $mailer;

    public function __construct(
        EventDispatcherInterface $dispatch,
        LoggerInterface $logger,
        MailerInterface $mailer
    ) {
        $this->dispatch = $dispatch;
        $this->logger = $logger;
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

        try {
            $message->send();
            $event = new MessageSent();
            $this->dispatch->dispatch($event);
        } catch (Exception $e) {
            $message = $e->getMessage();
            $this->logger->error($message);
            $event = new MessageNotSent($message);
            $this->dispatch->dispatch($event);
        }
    }
}
