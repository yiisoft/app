<?php

declare(strict_types=1);

namespace App\Service;

use Yiisoft\I18n\MessageReaderInterface;

final class MessageTranslator implements MessageReaderInterface
{
    private array $messages;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public function all($context = null): array
    {
        return $this->messages;
    }

    public function one(string $id, $context = null): ?string
    {
        return $this->messages[$id] ?? null;
    }

    public function plural(string $id, int $count, $context = null): ?string
    {
        return $this->messages[$id] ?? null;
    }
}
