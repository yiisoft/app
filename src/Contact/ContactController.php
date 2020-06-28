<?php


namespace App\Contact;


use App\Controller\AbstractController;
use App\Form\ContactForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Http\Header;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\Web\Flash;
use Yiisoft\Yii\Web\Middleware\Csrf;

class ContactController extends AbstractController
{
    public function contact(
        ContactForm $form,
        Flash $flash,
        ContactMailer $mailer,
        UrlGeneratorInterface $url,
        ServerRequestInterface $request
    ): ResponseInterface {
        $body = $request->getParsedBody();
        $method = $request->getMethod();

        if (($method === Method::POST) && $form->load($body) && $form->validate()) {
            $mailer->send($form, $request);

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
                    $url->generate('contact/form')
                );
        }

        return $this->render(
            'contact/form',
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
