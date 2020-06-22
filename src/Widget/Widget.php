<?php

declare(strict_types=1);

namespace App\Widget;

use Yiisoft\Widget\Widget as BaseWidget;

abstract class Widget extends BaseWidget
{
    use WidgetTrait;

    private ?string $id = null;
    private bool $autoGenerate = true;
    private static int $counter = 0;
    private static string $autoIdPrefix = 'w';

    /**
     * Returns the Id of the widget.
     *
     * @return string Id of the widget.
     */
    public function getId(): string
    {
        $new = clone $this;

        if ($new->autoGenerate) {
            $new->id = self::$autoIdPrefix . static::$counter++;
        }

        return $new->id;
    }

    /**
     * Set the Id of the widget.
     */
    public function setId(string $value): self
    {
        $new = clone $this;
        $new->id = $value;
        return $new;
    }

    /**
     * Counter used to generate {@see id} for widgets.
     */
    public static function counter(int $value): void
    {
        self::$counter = $value;
    }

    /**
     * The prefix to the automatically generated widget IDs.
     *
     * {@see getId()}
     */
    public static function autoIdPrefix(string $value): void
    {
        self::$autoIdPrefix = $value;
    }
}
