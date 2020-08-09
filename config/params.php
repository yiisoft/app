<?php

declare(strict_types=1);

use App\ApplicationParameters;
use Psr\Log\LogLevel;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Yii\Web\Middleware\Csrf;

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

    'yiisoft/cache-file' => [
        'file-cache' => [
            'path' => '@runtime/cache'
        ],
    ],

    'yiisoft/form' => [
        'fieldConfig' => [
            'inputCssClass()' => ['form-control input field'],
            'labelOptions()' => [['label' => '']],
            'errorOptions()' => [['class' => 'has-text-left has-text-danger is-italic']],
        ],
    ],

    'yiisoft/i18n' => [
        'locale' => 'en-US',
        'translator' => [
            'path' => '@message/en-US.php'
        ]
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
        ],
        'file-rotator' => [
            'maxfilesize' => 10,
            'maxfiles' => 5,
            'filemode' => null,
            'rotatebycopy' => null
        ],
    ],

    'yiisoft/mailer' => [
        'mailerInterface' => [
            'composerPath' => '@resources/mail',
            'writeToFiles' => true,
            'writeToFilesPath' => '@runtime/mail',
        ],
        'swiftSmtpTransport' => [
            'host' => 'smtp.example.com',
            'port' => 25,
            'encryption' => null,
            'username' => 'admin@example.com',
            'password' => ''
        ],
    ],

    'yiisoft/view' => [
        'basePath' => '@resources/layout',
        'defaultParameters' => [
            'applicationParameters' => ApplicationParameters::class,
            'assetManager' => AssetManager::class,
            'field' => Field::class,
            'url' => UrlGeneratorInterface::class,
            'urlMatcher' => UrlMatcherInterface::class,
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

    'yiisoft/yii-web' => [
        'session' => [
            'options' => ['cookie_secure' => 0],
            'handler' => null
        ],
    ],

    'app' => [
        'charset' => 'UTF-8',
        'language' => 'en',
        'name' => 'My Project',
        'csrfAttribute' => Csrf::REQUEST_NAME
    ],

    'mailer' => [
        'adminEmail' => 'admin@example.com',
    ],
];
