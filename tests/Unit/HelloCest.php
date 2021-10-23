<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Runner\ConfigFactory;
use App\Tests\UnitTester;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\Console\Tester\CommandTester;
use Yiisoft\Config\Config;
use Yiisoft\Di\Container;
use Yiisoft\Yii\Console\ExitCode;

final class HelloCest
{
    private ContainerInterface $container;

    public function _before(UnitTester $I): void
    {
        $config = $this->getConfig();

        $this->container = new Container(
            $config->get('console'),
            $config->get('providers'),
        );
    }

    public function testExecute(UnitTester $I): void
    {
        $app = new Application();
        $params = $this->getConfig()->get('params');

        $loader = new ContainerCommandLoader(
            $this->container,
            $params['yiisoft/yii-console']['commands']
        );

        $app->setCommandLoader($loader);

        $command = $app->find('hello');

        $commandCreate = new CommandTester($command);

        $commandCreate->setInputs(['yes']);

        $I->assertSame(ExitCode::OK, $commandCreate->execute([]));

        $output = $commandCreate->getDisplay(true);

        $I->assertStringContainsString('Hello!', $output);
    }

    private function getConfig(): Config
    {
        return ConfigFactory::create(null);
    }
}
