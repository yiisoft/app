<?php

declare(strict_types=1);

namespace App\Tests\Console;

use App\Tests\Support\ConsoleTester;

final readonly class HelloCest
{
    public function base(ConsoleTester $I): void
    {
        $I->runApp('hello');
        $I->canSeeResultCodeIs(0);
        $I->seeInShellOutput('Hello!');
    }
}
