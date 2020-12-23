<?php

declare(strict_types=1);

namespace App\Contact;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Header;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\ViewRenderer;

class ContactController
{
    private ResponseFactoryInterface $responseFactory;
    private ViewRenderer $viewRenderer;

    public function __construct(ViewRenderer $viewRenderer, ResponseFactoryInterface $responseFactory)
    {
        $this->viewRenderer = $viewRenderer->withControllerName('contact');
        $this->responseFactory = $responseFactory;
    }

    public function contact(
        ContactForm $form,
        ContactMailer $mailer,
        UrlGeneratorInterface $url,
        ServerRequestInterface $request
    ): ResponseInterface {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load((array) $body) && $form->validate()) {
            $mailer->send($form, $request);

            return $this->responseFactory
                ->createResponse(302)
                ->withHeader(
                    Header::LOCATION,
                    $url->generate('contact/form')
                );
        }

        return $this->viewRenderer->render(
            'form',
            [
                'form' => $form,
            ]
        );
    }
}
