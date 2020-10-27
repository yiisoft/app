<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Mailer\Composer;
use Yiisoft\Mailer\FileMailer;
use Yiisoft\Mailer\MailerInterface;
use Yiisoft\Mailer\MessageFactory;
use Yiisoft\Mailer\MessageFactoryInterface;
use Yiisoft\Mailer\SwiftMailer\Logger;
use Yiisoft\Mailer\SwiftMailer\Mailer;
use Yiisoft\Mailer\SwiftMailer\Message;
use Yiisoft\View\WebView;

/** @var array $params */

return [
    Composer::class => [
        '__class' => Composer::class,
        '__construct()' => [
            Reference::to(WebView::class),
            fn (Aliases $aliases) => $aliases->get($params['yiisoft/mailer']['composer']['composerView'])
        ]
    ],

    MessageFactory::class => [
        '__class' => MessageFactory::class,
        '__construct()' => [
            Message::class
        ]
    ],

    MessageFactoryInterface::class => MessageFactory::class,

    Logger::class => [
        '__class' => Logger::class,
        '__construct()' => [Reference::to(LoggerInterface::class)]
    ],

    Swift_SmtpTransport::class => [
        '__class' => Swift_SmtpTransport::class,
        '__construct()' => [
            $params['swiftmailer/swiftmailer']['SwiftSmtpTransport']['host'],
            $params['swiftmailer/swiftmailer']['SwiftSmtpTransport']['port'],
            $params['swiftmailer/swiftmailer']['SwiftSmtpTransport']['encryption']
        ],
        'setUsername()' => [$params['swiftmailer/swiftmailer']['SwiftSmtpTransport']['username']],
        'setPassword()' => [$params['swiftmailer/swiftmailer']['SwiftSmtpTransport']['password']]
    ],

    Swift_Plugins_LoggerPlugin::class => [
        '__class' => Swift_Plugins_LoggerPlugin::class,
        '__construct()' => [Reference::to(Logger::class)]
    ],

    Mailer::class => [
        '__class' => Mailer::class,
        'registerPlugin()' => [Reference::to(Swift_Plugins_LoggerPlugin::class)]
    ],

    FileMailer::class => [
        '__class' => FileMailer::class,
        '__construct()' => [
            'path' => fn (Aliases $aliases) => $aliases->get(
                $params['yiisoft/mailer']['fileMailer']['fileMailerStorage']
            )
        ]
    ],

    MailerInterface::class => $params['yiisoft/mailer']['writeToFiles']
        ? FileMailer::class : Mailer::class
];
