<?php

declare(strict_types=1);

namespace App\Contact\Event;

final class MessageNotSent
{
    private string $errorMessage;

    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
