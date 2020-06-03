<?php

declare(strict_types=1);

namespace App\Tests;

use App\Tests\AcceptanceTester;

class IndexFunctionalCest
{
    public function _before(FunctionalTester $I)
    {
        $I->wantTo('index page works.');
        $I->amOnPage('/');
    }

    public function testIndexPage(FunctionalTester $I): void
    {
        $I->expectTo('see page index.');
        $I->see('Hello World');
    }
}
