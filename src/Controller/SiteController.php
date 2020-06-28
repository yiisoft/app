<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ContactForm;
use App\Service\Mailer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Header;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\Web\Flash;
use Yiisoft\Yii\Web\Middleware\Csrf;

class SiteController extends AbstractController
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return $this->render(
            'site/index',
            [
                'csrf' => $request->getAttribute(Csrf::REQUEST_NAME)
            ]
        );
    }

    public function about(ServerRequestInterface $request): ResponseInterface
    {
        return $this->render(
            'site/about',
            [
                'csrf' => $request->getAttribute(Csrf::REQUEST_NAME)
            ]
        );
    }

    public function contact(
        ContactForm $form,
        Flash $flash,
        Mailer $mailer,
        UrlGeneratorInterface $url,
        ServerRequestInterface $request
    ): ResponseInterface {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {
            $message = $mailer->message($form);

            $attachFiles = $request->getUploadedFiles();

            foreach ($attachFiles as $attachFile) {
                foreach ($attachFile as $file) {
                    if ($file->getError() === UPLOAD_ERR_OK) {
                        $message->addFile($file);
                    }
                }
            }

            $mailer->send($message);

            $flash->add(
                'is-success',
                [
                    'header' => 'System mailer notification.',
                    'body' =>  'Thanks to contact us, we\'ll get in touch with you as soon as possible.'
                ],
                true
            );

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(
                    Header::LOCATION,
                    $url->generate('site/index')
                );
        }

        return $this->render(
            'site/contact',
            [
                'csrf' => $request->getAttribute(Csrf::REQUEST_NAME),
                'form' => $form
            ]
        );
    }

    public function getViewPath(): string
    {
        return $this->aliases->get('@views');
    }
}
