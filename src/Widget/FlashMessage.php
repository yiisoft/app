<?php

declare(strict_types=1);

namespace App\Widget;

use Yiisoft\Session\Flash\Flash;
use Yiisoft\Yii\Bulma\Message;

final class FlashMessage extends \Yiisoft\Widget\Widget
{
    private Flash $flash;
    private bool $withoutCloseButton = false;
    private string $size = '';

    public function __construct(Flash $flash)
    {
        $this->flash = $flash;
    }

    public function run(): string
    {
        $flashes = $this->flash->getAll();
        $html = '';

        foreach ($flashes as $type => $data) {
            foreach ($data as $message) {
                $html .= Message::widget()
                    ->headerColor($type)
                    ->headerMessage($message['header'] ?? '')
                    ->body($message['body'] ?? '')
                    ->withoutCloseButton($this->withoutCloseButton)
                    ->size($this->size)
                    ->render();
            }
        }

        return $html;
    }

    public function withoutCloseButton(bool $value): self
    {
        $new = clone $this;
        $new->withoutCloseButton = $value;
        return $new;
    }

    public function size(string $value): self
    {
        $new = clone $this;
        $new->size = $value;
        return $new;
    }
}
