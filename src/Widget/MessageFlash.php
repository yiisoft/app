<?php

declare(strict_types=1);

namespace App\Widget;

use App\Widget\Message;
use Yiisoft\Yii\Web\Flash;

final class MessageFlash extends Widget
{
    private Flash $flash;

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
                    ->headerMessage($message['header'])
                    ->body($message['body'])
                    ->closeButtonEnabled(false)
                    ->render();
            }
        }

        return $html;
    }
}
