<?php

declare(strict_types=1);

namespace App\Controller;

use App\ApplicationParameters;
use App\Form\ContactForm;
use App\Helper\Mailer;
use App\Helper\Message;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\Web\Flash;
use Yiisoft\Yii\Web\Middleware\Csrf;

class SiteController extends AbstractController
{
    protected function name(): string
    {
        return 'site';
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return $this->render(
            'index',
            [
                'csrf' => $request->getAttribute(Csrf::REQUEST_NAME)
            ]
        );
    }

    public function about(ServerRequestInterface $request): ResponseInterface
    {
        return $this->render(
            'about',
            [
                'csrf' => $request->getAttribute(Csrf::REQUEST_NAME)
            ]
        );
    }

    public function contact(
        ApplicationParameters $app,
        ContactForm $form,
        Flash $flash,
        Mailer $mailer,
        UrlGeneratorInterface $url,
        ServerRequestInterface $request
    ): ResponseInterface {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {
            $message = new Message(
                $form->getAttributeValue('username'),
                $form->getAttributeValue('email'),
                $form->getAttributeValue('subject'),
                $form->getAttributeValue('body'),
                $app->getEmail(),
            );

            $attachFiles = $request->getUploadedFiles();

            foreach ($attachFiles as $attachFile) {
                foreach ($attachFile as $key => $file) {
                    if ($file->getError() === UPLOAD_ERR_OK) {
                        $message->addFile($attachFile[$key]);
                    }
                }
            }

            $mailer->send($message);

            $flash->add(
                'info',
                [
                    'header' => 'System mailer notification.',
                    'body' =>  'Thanks to contact us, we\'ll get in touch with you as soon as possible.'
                ],
                true
            );

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(
                    'Location',
                    $url->generate('site/index')
                );
        }

        return $this->render(
            'contact',
            [
                'csrf' => $request->getAttribute(Csrf::REQUEST_NAME),
                'form' => $form
            ]
        );
    }
}
