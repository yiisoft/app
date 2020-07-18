<?php

declare(strict_types=1);

namespace App;

final class ApplicationParameters
{
    private string $charset = 'UTF-8';
    private string $language = 'en';
    private string $locale = 'en-US';
    private string $name = 'My Project';
    private string $email = 'support@example.com';

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

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function locale(string $value): self
    {
        $new = clone $this;
        $new->locale = $value;
        return $new;
    }

    public function name(string $value): self
    {
        $new = clone $this;
        $new->name = $value;
        return $new;
    }
}
