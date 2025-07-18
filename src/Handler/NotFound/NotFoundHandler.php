<?php

declare(strict_types=1);

namespace App\Handler\NotFound;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Http\Status;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\CurrentRoute;
use Yiisoft\Yii\View\Renderer\ViewRenderer;

final readonly class NotFoundHandler implements RequestHandlerInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private CurrentRoute $currentRoute,
        private ViewRenderer $viewRenderer,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->viewRenderer
            ->render(__DIR__ . '/404', ['urlGenerator' => $this->urlGenerator, 'currentRoute' => $this->currentRoute])
            ->withStatus(Status::NOT_FOUND);
    }
}
