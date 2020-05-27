<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\View\ViewContextInterface;
use Yiisoft\View\WebView;
use Yiisoft\Yii\Web\Data\DataResponseFactoryInterface;

use function is_file;
use function pathinfo;

abstract class Controller implements ViewContextInterface
{
    protected DataResponseFactoryInterface $responseFactory;
    private Aliases $aliases;
    private WebView $view;
    private string $layout;
    private array $parameters = [];

    public function __construct(
        DataResponseFactoryInterface $responseFactory,
        Aliases $aliases,
        WebView $view
    ) {
        $this->responseFactory = $responseFactory;
        $this->aliases = $aliases;
        $this->view = $view;
        $this->layout = $aliases->get('@layout') . '/main';
    }

    protected function render(string $view, array $parameters = []): ResponseInterface
    {
        $this->parameters = $parameters;

        $controller = $this;

        $contentRenderer = static function () use ($view, $parameters, $controller) {
            return $controller->renderContent($controller->view->render($view, $parameters, $controller));
        };

        return $this->responseFactory->createResponse($contentRenderer);
    }

    private function renderContent($content): string
    {
        $layout = $this->findLayoutFile($this->layout);

        if (is_file($layout)) {
            return $this->view->renderFile(
                $layout,
                array_merge(
                    [
                        'content' => $content
                    ],
                    $this->parameters
                ),
                $this
            );
        }

        return $content;
    }

    public function getViewPath(): string
    {
        return $this->aliases->get('@views') . '/' . $this->getId();
    }

    private function findLayoutFile(string $file): string
    {
        if (pathinfo($file, PATHINFO_EXTENSION) !== '') {
            return $file;
        }

        return $file . '.' . $this->view->getDefaultExtension();
    }

    abstract protected function getId(): string;
}
