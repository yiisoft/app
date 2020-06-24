<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\Yii\Web\Middleware\Csrf;

class SiteController extends AbstractController
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return $this->render(
            'index',
            [
                'csrf' => $request->getAttribute(Csrf::REQUEST_NAME)
            ]
        );
    }
}
