<?php

declare(strict_types=1);

namespace App\Widget;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_key_exists;

/**
 * Message renders bulma component.
 *
 * For example,
 *
 * ```php
 * echo Message::widget()
 *     ->options([
 *         'class' => 'alert-info',
 *     ])
 *     ->body('Say hello...');
 * ```
 */
final class Message extends Widget
{
    private ?string $body = null;
    private array $closeButton = [];
    private bool $closeButtonEnabled = true;
    private string $headerColor = 'is-dark';
    private array $headersColor = [
        'dark' => 'is-dark',
        'primary' => 'is-primary',
        'link' => 'is-link',
        'info' => 'is-info',
        'success' => 'is-success',
        'warning' => 'is-warning',
        'danger' => 'is-danger'
    ];
    private bool $headerEnabled = true;
    private ?string $headerMessage = null;
    private array $options = [];
    private array $optionsBody = [];
    private array $optionsHeader = [];
    private string $size = '';
    private array $sizes = [
        'small' => 'is-small',
        'large' => 'is-large'
    ];

    protected function run(): string
    {
        $new = clone $this;

        if (!isset($new->options['id'])) {
            $new->options['id'] = "{$this->getId()}-alert";
        }

        $new = $new->initOptions();

        $new->registerPlugin('message', $new->options);

        return
            Html::beginTag('div', $new->options) . "\n" .
                $new->renderHeader() .
                Html::beginTag('div', $new->optionsBody) . "\n" .
                    $new->renderBodyEnd() . "\n" .
                Html::endTag('div') . "\n" .
            Html::endTag('div');
    }

    private function renderHeader(): string
    {
        $html = '';
        $new = clone $this;

        if ($new->headerEnabled) {
            $html = Html::beginTag('div', $new->optionsHeader) . "\n" . $new->renderHeaderMessage() . "\n" .
                Html::endTag('div') . "\n";
        }

        return $html;
    }

    /**
     * Renders the message header and the close button (if any).
     *
     * @return string the rendering result
     */
    private function renderHeaderMessage(): string
    {
        $new = clone $this;

        $result = $new->headerMessage;

        if ($new->renderCloseButton() !== null) {
            $result = '<p>' . $new->headerMessage . '</p>' . "\n" . $new->renderCloseButton();
        }

        return $result;
    }

    /**
     * Renders the message body and the close button (if any).
     *
     * @return string the rendering result
     */
    private function renderBodyEnd(): string
    {
        return $this->body;
    }

    /**
     * Renders the close button.
     *
     * @return string|null the rendering result
     */
    private function renderCloseButton(): ?string
    {
        $new = clone $this;

        if ($new->closeButtonEnabled === false) {
            return null;
        }

        $tag = ArrayHelper::remove($new->closeButton, 'tag', 'button');
        $label = ArrayHelper::remove($new->closeButton, 'label', Html::tag('span', '&times;', [
            'aria-hidden' => 'true'
        ]));

        if ($tag === 'button' && !isset($new->closeButton['type'])) {
            $new->closeButton['type'] = 'button';
        }

        if ($new->size !== '') {
            Html::addCssClass($new->closeButton, ['class' => $new->size]);
        }

        return Html::tag($tag, $label, $new->closeButton);
    }

    /**
     * Initializes the widget options.
     *
     * This method sets the default values for various options.
     *
     * @return self
     */
    private function initOptions(): self
    {
        $new = clone $this;

        Html::addCssClass($new->options, ['widget' => 'message']);
        Html::addCssClass($new->options, [$new->headerColor]);

        if ($new->size !== '') {
            Html::addCssClass($new->options, [$new->size]);
        }

        Html::addCssClass($new->optionsHeader, ['widget' => 'message-header']);
        Html::addCssClass($new->optionsBody, ['widget' => 'message-body']);

        if ($new->closeButtonEnabled !== false) {
            $new->closeButton = [
                'class' => ['widget' => 'delete'],
                'aria-label' => 'delete'
            ];
        }

        return $new;
    }

    /**
     * The body content in the alert component. Alert widget will also be treated as the body content, and will be
     * rendered before this.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function body(?string $value): self
    {
        $new = clone $this;
        $new->body = $value;
        return $new;
    }

    /**
     * The options for rendering the close button tag.
     *
     * The close button is displayed in the header of the modal window. Clicking on the button will hide the modal
     * window. If {@see closeButtonEnabled} is false, no close button will be rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function closeButton(array $value): self
    {
        $new = clone $this;
        $new->closeButton = $value;
        return $new;
    }

    /**
     * Enable/Disable close button.
     *
     * @param bool $value
     *
     * @return self
     */
    public function closeButtonEnabled(bool $value): self
    {
        $new = clone $this;
        $new->closeButtonEnabled = $value;
        return $new;
    }

    public function headerColor(string $key): self
    {
        $new = clone $this;

        if (array_key_exists($key, $new->headersColor)) {
            $new->headerColor = $new->headersColor[$key];
        } else {
            $new->headerColor = $new->headersColor['dark'];
        }

        return $new;
    }

    public function headerEnabled(bool $value): self
    {
        $new = clone $this;
        $new->headerEnabled = $value;
        return $new;
    }

    /**
     * The header message in the message component. Messsage widget will also be treated as the header content, and will
     * be rendered before body.
     *
     * @param string|null $value
     *
     * @return self
     */
    public function headerMessage(?string $value): self
    {
        $new = clone $this;
        $new->headerMessage = $value;
        return $new;
    }

    /**
     * The HTML attributes for the widget container tag. The following special options are recognized.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;
        return $new;
    }

    /**
     * The HTML attributes for the widget body tag. The following special options are recognized.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function optionsBody(array $value): self
    {
        $new = clone $this;
        $new->optionsBody = $value;
        return $new;
    }

    /**
     * The HTML attributes for the widget header tag. The following special options are recognized.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function optionsHeader(array $value): self
    {
        $new = clone $this;
        $new->optionsHeader = $value;
        return $new;
    }

    public function size(string $key): self
    {
        $new = clone $this;

        if (array_key_exists($key, $new->sizes)) {
            $new->size = $new->sizes[$key];
        }

        return $new;
    }
}
