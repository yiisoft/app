<?php

declare(strict_types=1);

/* @var array $params */

use App\Provider\FieldProvider;
use App\Provider\FlashProvider;
use App\Provider\MailerInterfaceProvider;
use App\Provider\MiddlewareProvider;
use App\Provider\Psr17Provider;
use App\Provider\SessionProvider;
use App\Provider\SwiftTransportProvider;
use App\Provider\SwiftSmtpTransportProvider;
use App\Provider\ThemeProvider;
use App\Provider\WebViewProvider;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;

return [
    'yiisoft/yii-web/psr17' => Psr17Provider::class,
    'yiisoft/yii-web/middleware' => MiddlewareProvider::class,
    'yiisoft/yii-web/session' => [
        '__class' => SessionProvider::class,
        '__construct()' => [
            $params['yiisoft/yii-web']['session']['options'],
            $params['yiisoft/yii-web']['session']['handler']
        ],
    ],
    'yiisoft/yii-web/flash' => FlashProvider::class,
    'yiisoft/form/field' => [
        '__class' => FieldProvider::class,
        '__construct()' => [
            $params['yiisoft/form']['fieldConfig'],
        ],
    ],
    'yiisoft/mailer/swifttransport' => SwiftTransportProvider::class,
    'yiisoft/mailer/swiftsmtptransport' => [
        '__class' => SwiftSmtpTransportProvider::class,
        '__construct()' => [
            $params['yiisoft/mailer']['swiftSmtpTransport']['host'],
            $params['yiisoft/mailer']['swiftSmtpTransport']['port'],
            $params['yiisoft/mailer']['swiftSmtpTransport']['encryption'],
            $params['yiisoft/mailer']['swiftSmtpTransport']['username'],
            $params['yiisoft/mailer']['swiftSmtpTransport']['password']
        ],
    ],
    'yiisoft/mailer/mailerinterface' => [
        '__class' => MailerInterfaceProvider::class,
        '__construct()' => [
            $params['yiisoft/mailer']['mailerInterface']['composerPath'],
            $params['yiisoft/mailer']['mailerInterface']['writeToFiles'],
            $params['yiisoft/mailer']['mailerInterface']['writeToFilesPath'],
        ],
    ],
    'yiisoft/view/theme' => [
        '__class' => ThemeProvider::class,
        '__construct()' => [
            $params['yiisoft/view']['theme']['pathMap'],
            $params['yiisoft/view']['theme']['basePath'],
            $params['yiisoft/view']['theme']['baseUrl'],
        ],
    ],
    'yiisoft/view/webview' => [
        '__class' => WebViewProvider::class,
        '__construct()' => [
            $params['yiisoft/view']['defaultParameters'],
        ],
    ],

    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
