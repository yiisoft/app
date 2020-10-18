<?php

declare(strict_types=1);

namespace App\Provider;

use HttpSoft\Message\RequestFactory;
use HttpSoft\Message\ServerRequestFactory;
use HttpSoft\Message\ResponseFactory;
use HttpSoft\Message\StreamFactory;
use HttpSoft\Message\UploadedFileFactory;
use HttpSoft\Message\UriFactory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;

final class Psr17Provider extends ServiceProvider
{
    /**
     * @psalm-suppress InaccessibleMethod
     */
    public function register(Container $container): void
    {
        $container->set(RequestFactoryInterface::class, RequestFactory::class);
        $container->set(ServerRequestFactoryInterface::class, ServerRequestFactory::class);
        $container->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $container->set(StreamFactoryInterface::class, StreamFactory::class);
        $container->set(UriFactoryInterface::class, UriFactory::class);
        $container->set(UploadedFileFactoryInterface::class, UploadedFileFactory::class);
    }
}
