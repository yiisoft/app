<?php

declare(strict_types=1);

namespace App\Tests\Web;

use App\Tests\Support\WebTester;

final class NotFoundHandlerCest
{
    public function nonExistentPage(WebTester $I): void
    {
        $I->wantTo('see 404 page.');
        $I->amOnPage('/non-existent-page');
        $I->canSeeResponseCodeIs(404);
        $I->see('404');
        $I->see('The page /non-existent-page not found.');
        $I->see('The above error occurred while the Web server was processing your request.');
        $I->see('Please contact us if you think this is a server error. Thank you.');
    }

    public function returnHome(WebTester $I): void
    {
        $I->wantTo('check "Go Back Home" link.');
        $I->amOnPage('/non-existent-page');
        $I->canSeeResponseCodeIs(404);
        $I->click('Go Back Home');
        $I->expectTo('see page home.');
        $I->see('Hello!');
    }
}
