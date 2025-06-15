<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;
use HttpSoft\Message\ServerRequest;

use function PHPUnit\Framework\assertStringContainsString;

final class SiteControllerCest
{
    public function testGetIndex(FunctionalTester $tester): void
    {
        $response = $tester->sendRequest(
            new ServerRequest(uri: '/'),
        );

        assertStringContainsString(
            'Don\'t forget to check the guide',
            $response->getBody()->getContents(),
        );
    }
}
