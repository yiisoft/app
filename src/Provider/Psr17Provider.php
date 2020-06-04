<?php

declare(strict_types=1);

namespace App\Provider;

use Nyholm\Psr7\Factory\Psr17Factory;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Yiisoft\Yii\Web\Data\DataResponseFactory;
use Yiisoft\Yii\Web\Data\DataResponseFactoryInterface;
use Yiisoft\Yii\Web\Data\DataResponseFormatterInterface;
use Yiisoft\Yii\Web\Data\Formatter\HtmlDataResponseFormatter;

final class Psr17Provider extends ServiceProvider
{
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
