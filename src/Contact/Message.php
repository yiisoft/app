<?php

declare(strict_types=1);

namespace App\Contact;

use Psr\Http\Message\UploadedFileInterface;

final class Message
{
    private string $name;
    private string $email;
    private string $subject;
    private string $content;
    private array $files = [];
    private string $to;

    public function __construct(string $name, string $email, string $subject, string $content, string $to)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->content = $content;
        $this->to = $to;
    }

    public function addFile(UploadedFileInterface $file): void
    {
        $this->files[] = $file;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getTo(): string
    {
        return $this->to;
    }
}
