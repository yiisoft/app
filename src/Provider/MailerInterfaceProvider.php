<?php

declare(strict_types=1);

namespace App\Provider;

use Swift_Transport;
use Swift_Plugins_LoggerPlugin;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Di\Container;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Mailer\Composer;
use Yiisoft\Mailer\FileMailer;
use Yiisoft\Mailer\MailerInterface;
use Yiisoft\Mailer\MessageFactory;
use Yiisoft\Mailer\SwiftMailer\Logger;
use Yiisoft\Mailer\SwiftMailer\Mailer;
use Yiisoft\Mailer\SwiftMailer\Message;
use Yiisoft\View\WebView;

final class MailerInterfaceProvider extends ServiceProvider
{
    private string $composerPath;
    private bool $writeToFiles;
    private string $writeToFilesPath;

    public function __construct(
        string $composerPath = '@runtime/mail',
        bool $writeToFiles = false,
        string $writeToFilesPath = '@runtime/mail'
    ) {
        $this->composerPath = $composerPath;
        $this->writeToFiles = $writeToFiles;
        $this->writeToFilesPath = $writeToFilesPath;
    }

    /**
     * @suppress PhanAccessMethodProtected
     */
    public function register(Container $container): void
    {
        $container->set(MailerInterface::class, function (ContainerInterface $container) {
            $aliases = $container->get(Aliases::class);
            $logger = $container->get(LoggerInterface::class);
            $eventDispatcher = $container->get(EventDispatcherInterface::class);
            $view = $container->get(WebView::class);

            $messageFactory = new MessageFactory(Message::class);

            $composer = new Composer($view, $aliases->get($this->composerPath));

            if ($this->writeToFiles) {
                return new FileMailer(
                    $messageFactory,
                    $composer,
                    $eventDispatcher,
                    $logger,
                    $aliases->get($this->writeToFilesPath)
                );
            }

            $transport = $container->get(Swift_Transport::class);
            $mailer = new Mailer($messageFactory, $composer, $eventDispatcher, $logger, $transport);
            $mailer->registerPlugin(new Swift_Plugins_LoggerPlugin(new Logger($logger)));

            return $mailer;
        });
    }
}
