<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DotEnvLoader;
use Codeception\Test\Unit;

use function PHPUnit\Framework\assertSame;

final class DotEnvLoaderTest extends Unit
{
    private string $testEnvFile;

    protected function _before(): void
    {
        $this->testEnvFile = sys_get_temp_dir() . '/test_' . uniqid() . '.env';
    }

    protected function _after(): void
    {
        if (file_exists($this->testEnvFile)) {
            unlink($this->testEnvFile);
        }
    }

    public function testLoadEnvFileWithBasicVariables(): void
    {
        $content = <<<'ENV_WRAP'
        APP_ENV=dev
        APP_DEBUG=true
        ENV_WRAP;
        file_put_contents($this->testEnvFile, $content);

        DotEnvLoader::load($this->testEnvFile);

        assertSame('dev', $_ENV['APP_ENV']);
        assertSame('true', $_ENV['APP_DEBUG']);
    }

    public function testLoadEnvFileWithQuotedValues(): void
    {
        $content = <<<'ENV'
QUOTED_DOUBLE="test value"
QUOTED_SINGLE='another value'
ENV;
        file_put_contents($this->testEnvFile, $content);

        DotEnvLoader::load($this->testEnvFile);

        assertSame('test value', $_ENV['QUOTED_DOUBLE']);
        assertSame('another value', $_ENV['QUOTED_SINGLE']);
    }

    public function testLoadEnvFileSkipsComments(): void
    {
        $content = <<<'ENV_WRAP'
        # This is a comment
        APP_ENV=dev
        # Another comment
        APP_DEBUG=true
        ENV_WRAP;
        file_put_contents($this->testEnvFile, $content);

        DotEnvLoader::load($this->testEnvFile);

        assertSame('dev', $_ENV['APP_ENV']);
        assertSame('true', $_ENV['APP_DEBUG']);
    }

    public function testLoadNonExistentFileDoesNothing(): void
    {
        // Should not throw an exception
        DotEnvLoader::load('/non/existent/file.env');

        // Test passes if no exception is thrown
        assertSame(1, 1);
    }

    public function testLoadDoesNotOverrideExistingVariables(): void
    {
        $_ENV['EXISTING_VAR'] = 'original';
        putenv('EXISTING_VAR=original');

        $content = <<<'ENV'
EXISTING_VAR=new_value
ENV;
        file_put_contents($this->testEnvFile, $content);

        DotEnvLoader::load($this->testEnvFile);

        assertSame('original', $_ENV['EXISTING_VAR']);
    }
}
