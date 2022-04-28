<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\Support\AcceptanceTester;

final class HomeCest
{
    public function testIndexPage(AcceptanceTester $I): void
    {
        $I->wantTo('index page works.');
        $I->amOnPage('/');
        $I->expectTo('see page index.');
        $I->see('Hello');
    }
}
