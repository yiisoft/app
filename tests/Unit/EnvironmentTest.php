<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Environment;
use Codeception\Test\Unit;
use RuntimeException;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

final class EnvironmentTest extends Unit
{
    /** @var array<string, string|false> */
    private array $originalEnv = [];

    protected function _before(): void
    {
        foreach (['APP_ENV', 'APP_DEBUG', 'APP_C3', 'APP_HOST_PATH'] as $key) {
            $this->originalEnv[$key] = getenv($key);
        }
    }

    protected function _after(): void
    {
        foreach ($this->originalEnv as $key => $value) {
            if ($value === false) {
                putenv($key);
                unset($_ENV[$key]);
            } else {
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }
        Environment::prepare();
    }

    public function testAppEnvIsReadFromEnvironment(): void
    {
        $this->setEnv('APP_ENV', 'test');

        assertSame('test', Environment::appEnv());
    }

    public function testAppEnvDefaultsToProdWhenNotSet(): void
    {
        $this->unsetEnv('APP_ENV');

        assertSame('prod', Environment::appEnv());
    }

    public function testAppEnvDefaultsToProdWhenEmpty(): void
    {
        $this->setEnv('APP_ENV', '');

        assertSame('prod', Environment::appEnv());
    }

    public function testInvalidAppEnvThrows(): void
    {
        $this->unsetEnv('APP_ENV');
        putenv('APP_ENV=staging');

        try {
            Environment::prepare();
            $this->fail('Expected RuntimeException was not thrown.');
        } catch (RuntimeException $e) {
            assertSame('APP_ENV="staging" is invalid. Valid values are "dev", "test", "prod".', $e->getMessage());
        } finally {
            putenv('APP_ENV');
        }
    }

    public function testIsDev(): void
    {
        $this->setEnv('APP_ENV', 'dev');

        assertTrue(Environment::isDev());
        assertFalse(Environment::isTest());
        assertFalse(Environment::isProd());
    }

    public function testIsTest(): void
    {
        $this->setEnv('APP_ENV', 'test');

        assertTrue(Environment::isTest());
        assertFalse(Environment::isDev());
        assertFalse(Environment::isProd());
    }

    public function testIsProd(): void
    {
        $this->setEnv('APP_ENV', 'prod');

        assertTrue(Environment::isProd());
        assertFalse(Environment::isDev());
        assertFalse(Environment::isTest());
    }

    public function testAppDebugDefaultsToFalse(): void
    {
        $this->unsetEnv('APP_DEBUG');

        assertFalse(Environment::appDebug());
    }

    public function testAppDebugTrue(): void
    {
        $this->setEnv('APP_DEBUG', 'true');

        assertTrue(Environment::appDebug());
    }

    public function testAppDebugFalse(): void
    {
        $this->setEnv('APP_DEBUG', 'false');

        assertFalse(Environment::appDebug());
    }

    public function testAppC3DefaultsToFalse(): void
    {
        $this->unsetEnv('APP_C3');

        assertFalse(Environment::appC3());
    }

    public function testAppC3True(): void
    {
        $this->setEnv('APP_C3', 'true');

        assertTrue(Environment::appC3());
    }

    public function testAppHostPathDefaultsToNull(): void
    {
        $this->unsetEnv('APP_HOST_PATH');

        assertNull(Environment::appHostPath());
    }

    public function testAppHostPathIsRead(): void
    {
        $this->setEnv('APP_HOST_PATH', '/projects/myapp');

        assertSame('/projects/myapp', Environment::appHostPath());
    }

    public function testAppHostPathEmptyStringTreatedAsNull(): void
    {
        $this->setEnv('APP_HOST_PATH', '');

        assertNull(Environment::appHostPath());
    }

    private function setEnv(string $key, string $value): void
    {
        putenv("$key=$value");
        $_ENV[$key] = $value;
        Environment::prepare();
    }

    private function unsetEnv(string $key): void
    {
        putenv($key);
        unset($_ENV[$key]);
        Environment::prepare();
    }
}
