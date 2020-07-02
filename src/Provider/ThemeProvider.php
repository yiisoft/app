<?php

declare(strict_types=1);

namespace App\Provider;

use Yiisoft\Aliases\Aliases;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\View\Theme;

final class ThemeProvider extends ServiceProvider
{
    private array $pathMap;
    private string $basePath;
    private string $baseUrl;

    public function __construct(array $pathMap = [], string $basePath = '', string $baseUrl = '')
    {
        $this->pathMap = $pathMap;
        $this->basePath = $basePath;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $aliases = $container->get(Aliases::class);

        $pathMap = $this->pathMap;
        foreach ($pathMap as $key => $value) {
            $this->pathMap = [
                $aliases->get($key) => $aliases->get($value)
            ];
        }

        $container->set(
            Theme::class,
            fn () => new Theme($this->pathMap, $this->basePath, $this->baseUrl)
        );
    }
}
