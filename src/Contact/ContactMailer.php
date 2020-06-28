<?php

declare(strict_types=1);

namespace App\Contact;

use App\Service\Mailer;
use App\Service\Message;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Form\FormModelInterface;

/**
 * ContactMailer sends an email from the contact form
 */
final class ContactMailer
{
    private Mailer $mailer;
    private string $to;

    public function __construct(Mailer $mailer, string $to)
    {
        $this->mailer = $mailer;
        $this->to = $to;
    }

    public function send(FormModelInterface $form, ServerRequestInterface $request)
    {
        $message = new Message(
            $form->getAttributeValue('username'),
            $form->getAttributeValue('email'),
            $form->getAttributeValue('subject'),
            $form->getAttributeValue('body'),
            $this->to,
        );

        $attachFiles = $request->getUploadedFiles();

        foreach ($attachFiles as $attachFile) {
            foreach ($attachFile as $file) {
                if ($file->getError() === UPLOAD_ERR_OK) {
                    $message->addFile($file);
                }
            }
        }

        $this->mailer->send($message);
    }
}
