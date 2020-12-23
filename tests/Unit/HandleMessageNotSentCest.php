<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Tests\UnitTester;
use App\Event\HandleMessageNotSent;
use App\Contact\Event\MessageNotSent;
use Yiisoft\Session\Session;
use Yiisoft\Session\Flash\Flash;

final class HandleMessageNotSentCest
{
    public function testExecute(UnitTester $I): void
    {
        $expected = [
            '__counters' => [
                'is-danger' => -1,
            ],
            'is-danger' => [
                [
                    'header' => "System mailer notification.",
                    'body' => 'testMe',
                ]
            ]
        ];

        $session = new Session();
        $flash = new Flash($session);
        $event = new MessageNotSent('testMe');
        $listener = new HandleMessageNotSent();

        $listener->addFlash($event, $flash);

        $I->assertEquals($expected, $session->get('__flash'));
    }
}
