<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\VersionProvider;
use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Testing\FunctionalTester;

final class SiteControllerTest extends TestCase
{
    private ?FunctionalTester $tester;

    protected function setUp(): void
    {
        $this->tester = new FunctionalTester();
    }

    public function testGetIndex()
    {
        $method = 'GET';
        $url = '/';

        $this->tester->bootstrapApplication('web', dirname(__DIR__, 2));
        $response = $this->tester->doRequest($method, $url);

        $this->assertStringContainsString(
            'Don\'t forget to check the guide',
            $response->getContent()
        );
    }
}
