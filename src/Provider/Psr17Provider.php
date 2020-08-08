<?php

declare(strict_types=1);

namespace App\Provider;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Yiisoft\DataResponse\DataResponseFactory;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\DataResponseFormatterInterface;
use Yiisoft\DataResponse\Formatter\HtmlDataResponseFormatter;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class Psr17Provider extends ServiceProvider
{
    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(RequestFactoryInterface::class, Psr17Factory::class);
        $container->set(ServerRequestFactoryInterface::class, Psr17Factory::class);
        $container->set(ResponseFactoryInterface::class, Psr17Factory::class);
        $container->set(StreamFactoryInterface::class, Psr17Factory::class);
        $container->set(UriFactoryInterface::class, Psr17Factory::class);
        $container->set(UploadedFileFactoryInterface::class, Psr17Factory::class);
        $container->set(DataResponseFormatterInterface::class, HtmlDataResponseFormatter::class);
        $container->set(DataResponseFactoryInterface::class, DataResponseFactory::class);
    }
}
