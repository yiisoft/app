<?php

declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Strings\Inflector;
use Yiisoft\View\ViewContextInterface;
use Yiisoft\View\WebView;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

final class ViewRenderer implements ViewContextInterface
{
    protected ?string $name = null;
    protected DataResponseFactoryInterface $responseFactory;
    protected ApplicationParameters $applicationParameters;

    private UrlMatcherInterface $urlMatcher;
    private Aliases $aliases;
    private WebView $view;
    private string $layout;
    private ?string $viewBasePath;
    private ?string $viewPath = null;
    private ?string $csrfToken = null;
    private string $csrfTokenRequestAttribute;

    public function __construct(
        DataResponseFactoryInterface $responseFactory,
        ApplicationParameters $applicationParameters,
        Aliases $aliases,
        WebView $view,
        UrlMatcherInterface $urlMatcher,
        string $viewBasePath,
        string $layout
    ) {
        $this->responseFactory = $responseFactory;
        $this->applicationParameters = $applicationParameters;
        $this->aliases = $aliases;
        $this->view = $view;
        $this->urlMatcher = $urlMatcher;
        $this->viewBasePath = $viewBasePath;
        $this->layout = $layout;
    }

    public function getViewPath(): string
    {
        if ($this->viewPath !== null) {
            return $this->viewPath;
        }

        return $this->aliases->get($this->viewBasePath) . '/' . $this->name;
    }

    public function render(string $view, array $parameters = []): ResponseInterface
    {
        $contentRenderer = fn () => $this->renderProxy($view, $parameters);

        return $this->responseFactory->createResponse($contentRenderer);
    }

    public function renderPartial(string $view, array $parameters = []): ResponseInterface
    {
        $content = $this->view->render($view, $parameters, $this);

        return $this->responseFactory->createResponse($content);
    }

    public function withController(object $controller): self
    {
        $new = clone $this;
        $new->name = $this->getName($controller);

        return $new;
    }

    public function withControllerName(string $name): self
    {
        $new = clone $this;
        $new->name = $name;

        return $new;
    }

    public function withViewPath(string $viewPath): self
    {
        $new = clone $this;
        $new->viewPath = $viewPath;

        return $new;
    }

    public function withViewBasePath(string $viewBasePath): self
    {
        $new = clone $this;
        $new->viewBasePath = $viewBasePath;

        return $new;
    }

    public function withLayout(string $layout): self
    {
        $new = clone $this;
        $new->layout = $layout;

        return $new;
    }

    public function withCsrf(?string $requestAttribute = null): self
    {
        $new = clone $this;
        $new->csrfTokenRequestAttribute = $requestAttribute ?? $this->applicationParameters->getCsrfAttribute();
        $new->csrfToken = $new->getCsrfToken();

        return $new;
    }

    private function renderProxy(string $view, array $parameters = []): string
    {
        if ($this->csrfToken !== null) {
            $parameters['csrf'] = $this->csrfToken;
            $this->view->registerMetaTag(
                [
                    'name' => 'csrf',
                    'content' => $this->csrfToken,
                ],
                'csrf_meta_tags'
            );
        }
        $content = $this->view->render($view, $parameters, $this);
        $layout = $this->findLayoutFile($this->aliases->get($this->layout));

        if ($layout === null) {
            return $content;
        }

        $layoutParameters['content'] = $content;

        return $this->view->renderFile(
            $layout,
            $layoutParameters,
            $this,
        );
    }

    private function findLayoutFile(?string $file): ?string
    {
        if ($file === null) {
            return null;
        }

        if (pathinfo($file, PATHINFO_EXTENSION) !== '') {
            return $file;
        }

        return $file . '.' . $this->view->getDefaultExtension();
    }

    /**
     * Returns the controller name. Name should be converted to "id" case.
     * Method returns classname without `controller` on the ending.
     * If namespace is not contain `controller` or `controllers`
     * then returns only classname without `controller` on the ending
     * else returns all subnamespaces from `controller` (or `controllers`) to the end
     *
     * @return string
     * @example App\Controller\FooBar\BazController -> foo-bar/baz
     * @example App\Controllers\FooBar\BazController -> foo-bar/baz
     * @example Path\To\File\BlogController -> blog
     * @see Inflector::camel2id()
     */
    private function getName(object $controller): string
    {
        if ($this->name !== null) {
            return $this->name;
        }

        $regexp = '/((?<=controller\\\|s\\\)(?:[\w\\\]+)|(?:[a-z]+))controller/iuU';
        if (!preg_match($regexp, get_class($controller), $m) || empty($m[1])) {
            throw new \RuntimeException('Cannot detect controller name');
        }

        $inflector = new Inflector();
        $name = str_replace('\\', '/', $m[1]);

        return $this->name = $inflector->camel2id($name);
    }

    private function getCsrfToken(): string
    {
        return $this->urlMatcher->getLastMatchedRequest()->getAttribute($this->csrfTokenRequestAttribute);
    }
}
