<?php

declare(strict_types=1);

namespace App;

use Yiisoft\Yii\Web\Middleware\Csrf;

final class ApplicationParameters
{
    private string $charset = 'UTF-8';
    private string $language = 'en';
    private string $name = 'My Project';
    private string $email = 'support@example.com';
    private string $csrfAttribute = Csrf::REQUEST_NAME;

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCsrfAttribute(): string
    {
        return $this->csrfAttribute;
    }

    public function charset(string $value): self
    {
        $new = clone $this;
        $new->charset = $value;
        return $new;
    }

    public function email(string $value): self
    {
        $new = clone $this;
        $new->email = $value;
        return $new;
    }

    public function language(string $value): self
    {
        $new = clone $this;
        $new->language = $value;
        return $new;
    }

    public function name(string $value): self
    {
        $new = clone $this;
        $new->name = $value;
        return $new;
    }

    public function csrfAttribute(string $value): self
    {
        $new = clone $this;
        $new->csrfAttribute = $value;
        return $new;
    }
}
