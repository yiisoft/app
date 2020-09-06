<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\AcceptanceTester;

final class ContactCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/contact');
    }

    public function contactPageWorks(AcceptanceTester $I)
    {
        $I->wantTo('ensure that contact page works');
        $I->see('Please fill out the following to Contact.');
    }

    public function contactFormCanBeSubmitted(AcceptanceTester $I)
    {
        $I->amGoingTo('submit contact form with correct data');
        $I->fillField('#contactform-username', 'tester');
        $I->fillField('#contactform-email', 'tester@example.com');
        $I->fillField('#contactform-subject', 'test subject');
        $I->fillField('#contactform-body', 'test content');

        $I->click('contact-button');

        $I->dontSeeElement('#contact-form');
        $I->see("Thanks to contact us, we'll get in touch with you as soon as possible.");
    }
}
