<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\Console\Tester\CommandTester;
use App\Tests\UnitTester;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Di\Container;

final class HelloCest
{
    private ContainerInterface $container;

    public function _before(UnitTester $I): void
    {
        $this->container = new Container(
            require Builder::path('console'),
            require Builder::path('providers'),
        );
    }

    public function testExecute(UnitTester $I): void
    {
        $app = new Application();
        $params = require Builder::path('params');

        $loader = new ContainerCommandLoader(
            $this->container,
            $params['yiisoft/yii-console']['commands']
        );

        $app->setCommandLoader($loader);

        $command = $app->find('hello');

        $commandCreate = new CommandTester($command);

        $commandCreate->setInputs(['yes']);

        $I->assertEquals(1, $commandCreate->execute([]));

        $output = $commandCreate->getDisplay(true);

        $I->assertStringContainsString('Hello!', $output);
    }
}
