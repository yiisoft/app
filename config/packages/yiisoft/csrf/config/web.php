<?php

declare(strict_types=1);

/* @var array $params */

use Yiisoft\Csrf\MaskedCsrfToken;
use Yiisoft\Csrf\CsrfTokenInterface;
use Yiisoft\Csrf\Synchronizer\Generator\RandomCsrfTokenGenerator;
use Yiisoft\Csrf\Synchronizer\Storage\SessionCsrfTokenStorage;
use Yiisoft\Csrf\Synchronizer\SynchronizerCsrfToken;
use Yiisoft\Csrf\Hmac\IdentityGenerator\SessionCsrfTokenIdentityGenerator;
use Yiisoft\Csrf\Hmac\HmacCsrfToken;
use Yiisoft\Factory\Definitions\Reference;

return [
    CsrfTokenInterface::class => [
        '__class' => MaskedCsrfToken::class,
        '__construct()' => [
            'token' => Reference::to(SynchronizerCsrfToken::class),
        ],
    ],

    SynchronizerCsrfToken::class => [
        '__construct()' => [
            'generator' => Reference::to(RandomCsrfTokenGenerator::class),
            'storage' => Reference::to(SessionCsrfTokenStorage::class),
        ],
    ],

    HmacCsrfToken::class => [
        '__construct()' => [
            'identityGenerator' => Reference::to(SessionCsrfTokenIdentityGenerator::class),
            'secretKey' => $params['yiisoft/csrf']['hmacToken']['secretKey'],
            'algorithm' => $params['yiisoft/csrf']['hmacToken']['algorithm'],
            'lifetime' => $params['yiisoft/csrf']['hmacToken']['lifetime'],
        ],
    ],
];
