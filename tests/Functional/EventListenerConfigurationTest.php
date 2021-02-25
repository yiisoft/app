<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Di\Container;
use Yiisoft\Yii\Event\ListenerConfigurationChecker;

class EventListenerConfigurationTest extends TestCase
{
    public function testConsoleListenerConfiguration(): void
    {
        $container = (new Container(require Builder::path('console')))->get(ContainerInterface::class);
        $checker = $container->get(ListenerConfigurationChecker::class);
        $checker->check(require Builder::path('events-console'));

        self::assertInstanceOf(ListenerConfigurationChecker::class, $checker);
    }
}
