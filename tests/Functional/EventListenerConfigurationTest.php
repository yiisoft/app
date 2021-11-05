<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Runner\ConfigFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Yii\Event\ListenerConfigurationChecker;

class EventListenerConfigurationTest extends TestCase
{
    public function testConsoleListenerConfiguration(): void
    {
        $config = ConfigFactory::create(null);

        $container = (new Container($config->get('console')))->get(ContainerInterface::class);
        $checker = $container->get(ListenerConfigurationChecker::class);
        $checker->check($config->get('events-console'));

        self::assertInstanceOf(ListenerConfigurationChecker::class, $checker);
    }
}
