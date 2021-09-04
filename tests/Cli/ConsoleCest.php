<?php

declare(strict_types=1);

namespace App\Tests\Cli;

use App\Tests\CliTester;

final class ConsoleCest
{
    public function testCommandYii(CliTester $I): void
    {
        $I->runShellCommand(dirname(__DIR__, 2) . '/./yii');
        $I->seeInShellOutput('Yii Console');
    }

    public function testCommandHello(CliTester $I): void
    {
        $I->runShellCommand(dirname(__DIR__, 2) . '/./yii hello');
        $I->seeInShellOutput('Hello!' . PHP_EOL);
    }
}
