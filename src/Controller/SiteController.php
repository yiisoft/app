<?php

declare(strict_types=1);

namespace App\Controller;

use App\ViewRenderer;
use Psr\Http\Message\ResponseInterface;

class SiteController
{
    private ViewRenderer $viewRenderer;

    public function __construct(ViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer->withControllerName('site');
    }
    public function index(): ResponseInterface
    {
        return $this->viewRenderer->render('index');
    }

    public function about(): ResponseInterface
    {
        return $this->viewRenderer->render('about');
    }
}
