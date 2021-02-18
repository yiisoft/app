<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\AcceptanceTester;

final class ErrorCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->amOnPage('/error');
    }

    public function aboutPage(AcceptanceTester $I): void
    {
        $I->wantTo('see about page.');
        $I->see('404');
        $I->see('The page /error not found.');
        $I->see('The above error occurred while the Web server was processing your request.');
        $I->see('Please contact us if you think this is a server error. Thank you.');
    }
}
