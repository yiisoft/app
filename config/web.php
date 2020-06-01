<?php

declare(strict_types=1);

use App\Factory\MiddlewareDispatcherFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
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
use Yiisoft\Yii\Web\MiddlewareDispatcher;
use Yiisoft\Yii\Web\Session\Session;
use Yiisoft\Yii\Web\Session\SessionInterface;

/**
 * @var array $params
 */

return [
    /** PSR-17 */
    RequestFactoryInterface::class => Psr17Factory::class,
    ServerRequestFactoryInterface::class => Psr17Factory::class,
    ResponseFactoryInterface::class => Psr17Factory::class,
    StreamFactoryInterface::class => Psr17Factory::class,
    UriFactoryInterface::class => Psr17Factory::class,
    UploadedFileFactoryInterface::class => Psr17Factory::class,
    DataResponseFormatterInterface::class => HtmlDataResponseFormatter::class,
    DataResponseFactoryInterface::class => DataResponseFactory::class,

    /** MIDDLEWARE */
    MiddlewareDispatcher::class => new MiddlewareDispatcherFactory(),

    /** SESSION */
    SessionInterface::class => [
        '__class' => Session::class,
        '__construct()' => [
            $params['yiisoft/app']['session']['options'] ?? [],
            $params['yiisoft/app']['session']['handler'] ?? null,
        ],
    ],
];
