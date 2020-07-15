<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

class SiteController extends AbstractController
{
    public function index(): ResponseInterface
    {
        return $this->render('site/index');
    }

    public function about(): ResponseInterface
    {
        return $this->render('site/about');
    }

    public function getViewPath(): string
    {
        return $this->aliases->get('@views');
    }
}
