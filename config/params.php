<?php

declare(strict_types=1);

use App\ApplicationParameters;
use Psr\Log\LogLevel;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;

return [
    'aliases' => [
        '@root' => dirname(__DIR__),
        '@assets' => '@root/public/assets',
        '@assetsUrl' => '/assets',
        '@npm' => '@root/node_modules',
        '@public' => '@root/public',
        '@resources' => '@root/resources',
        '@runtime' => '@root/runtime',
        '@views' => '@root/resources/views',
        '@message' => '@root/resources/message'
    ],

    'yiisoft/form' => [
        'fieldConfig' => [
            'inputCssClass()' => ['form-control input field'],
            'labelOptions()' => [['label' => '']],
            'errorOptions()' => [['class' => 'has-text-left has-text-danger is-italic']],
        ],
    ],

    'yiisoft/log-target-file' => [
        'file-target' => [
            'file' => '@runtime/logs/app.log',
            'levels' => [
                LogLevel::EMERGENCY,
                LogLevel::ERROR,
                LogLevel::WARNING,
                LogLevel::INFO,
                LogLevel::DEBUG,
            ],
            'dirMode' => 0755,
            'fileMode' => null
        ],
        'file-rotator' => [
            'maxFileSize' => 10,
            'maxFiles' => 5,
            'fileMode' => null,
            'rotateByCopy' => null
        ]
    ],

    'yiisoft/mailer' => [
        'composer' => [
            'composerView' => '@resources/mail'
        ],
        'fileMailer' => [
            'fileMailerStorage' => '@runtime/mail'
        ],
        'writeToFiles' => true
    ],

    'swiftmailer/swiftmailer' => [
        'SwiftSmtpTransport' => [
            'host' => 'smtp.example.com',
            'port' => 25,
            'encryption' => null,
            'username' => 'admin@example.com',
            'password' => ''
        ]
    ],

    'yiisoft/view' => [
        'basePath' => '@views',
        'defaultParameters' => [
            'applicationParameters' => Reference::to(ApplicationParameters::class),
            'assetManager' => Reference::to(AssetManager::class),
            'field' => Reference::to(Field::class),
            'url' => Reference::to(UrlGeneratorInterface::class),
            'urlMatcher' => Reference::to(UrlMatcherInterface::class),
        ],
        'theme' => [
            'pathMap' => [],
            'basePath' => '',
            'baseUrl' => '',
        ]
    ],

    'yiisoft/yii-debug' => [
        'enabled' => true
    ],

    'yiisoft/yii-view' => [
        'viewBasePath' => '@views',
        'layout' => '@resources/layout/main',
    ],

    'app' => [
        'charset' => 'UTF-8',
        'language' => 'en',
        'name' => 'My Project',
    ],

    'mailer' => [
        'adminEmail' => 'admin@example.com',
    ],
];
