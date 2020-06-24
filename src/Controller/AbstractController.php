<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Strings\Inflector;
use Yiisoft\View\ViewContextInterface;
use Yiisoft\View\WebView;
use Yiisoft\Yii\Web\Data\DataResponseFactoryInterface;

use function is_file;
use function pathinfo;

abstract class AbstractController implements ViewContextInterface
{
    protected static ?string $controllerName = null;
    private string $layout;
    private WebView $view;
    protected Aliases $aliases;
    protected DataResponseFactoryInterface $responseFactory;

    public function __construct(
        DataResponseFactoryInterface $responseFactory,
        Aliases $aliases,
        WebView $view
    ) {
        $this->responseFactory = $responseFactory;
        $this->aliases = $aliases;
        $this->view = $view;
        $this->layout = $aliases->get('@resources/layout') . '/main';
    }

    protected function render(string $view, array $parameters = []): ResponseInterface
    {
        $contentRenderer = fn () => $this->renderContent($view, $parameters);

        return $this->responseFactory->createResponse($contentRenderer);
    }

    private function renderContent(string $view, array $parameters = []): string
    {
        $content = $this->view->render($view, $parameters, $this);
        $layout = $this->findLayoutFile($this->layout);

        if (is_file($layout)) {
            return $this->view->renderFile(
                $layout,
                array_merge(
                    [
                        'content' => $content
                    ],
                    $parameters
                ),
                $this
            );
        }

        return $content;
    }

    public function getViewPath(): string
    {
        return $this->aliases->get('@views') . '/' . self::getName();
    }

    private function findLayoutFile(string $file): string
    {
        if (pathinfo($file, PATHINFO_EXTENSION) !== '') {
            return $file;
        }

        return $file . '.' . $this->view->getDefaultExtension();
    }

    /**
     * Returns the controller name. Name should be converted to "id" case.
     *
     * @return string
     * @example If class named MySiteController method will return my-site
     * @see Inflector::camel2id()
     */
    protected static function getName(): string
    {
        if (static::$controllerName !== null) {
            return static::$controllerName;
        }

        $name = preg_replace('/(?:.*\\\)([a-z]+)(controller)/iu', '$1', static::class);
        $inflector = new Inflector();

        return $inflector->camel2id($name);
    }
}
