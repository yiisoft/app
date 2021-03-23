<?php

declare(strict_types=1);

use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\Input\InputOption;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Yii\Console\Application;
use Yiisoft\Yii\Console\CommandLoader;
use Yiisoft\Yii\Console\SymfonyEventDispatcher;

/** @var array $params */

return [
    CommandLoaderInterface::class => [
        '__class' => CommandLoader::class,
        '__construct()' => [
            'commandMap' => $params['yiisoft/yii-console']['commands'],
        ],
    ],

    Application::class => [
        '__class' => Application::class,
        'setDispatcher()' => [Reference::to(SymfonyEventDispatcher::class)],
        'setCommandLoader()' => [Reference::to(CommandLoaderInterface::class)],
        'addOptions()' => [
            new InputOption(
                'config',
                null,
                InputOption::VALUE_REQUIRED,
                'Set alternative configuration name'
            ),
        ],
        'setName()' => [$params['yiisoft/yii-console']['name']],
        'setVersion()' => [$params['yiisoft/yii-console']['version']],
        'setAutoExit()' => [$params['yiisoft/yii-console']['autoExit']],
    ],
];
