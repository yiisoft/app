<?php

declare(strict_types=1);

namespace App\Widget;

use Yii\Extension\Bulma\Asset\BulmaAsset;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Json\Json;

trait WidgetTrait
{
    private ?AssetManager $assetManager = null;
    private array $clientOptions = [];
    private array $clientEvents = [];
    private bool $enableClientOptions = false;
    private ?object $webView = null;

    /**
     * Registers a specific Bulma plugin and the related events.
     *
     * @param string $name the name of the Bulma plugin
     * @param array $options
     *
     * @return void
     */
    protected function registerPlugin(string $name, array $options = []): void
    {
        $id = $options['id'];

        $new = clone $this;

        if ($new->assetManager !== null) {
            $new->assetManager->register([
                BulmaAsset::class
            ]);
        }

        if ($new->webView !== null) {
            $new->webView->setCssFiles($new->assetManager->getCssFiles());
            $new->webView->setJsFiles($new->assetManager->getJsFiles());
        }

        if ($new->enableClientOptions !== false) {
            $optionsString = Json::htmlEncode($new->clientOptions);
            $js = "jQuery('#$id').$name($optionsString);";

            if ($new->webView !== null) {
                $new->webView->registerJs($js);
            }
        }

        $new->registerClientEvents($id);
    }

    /**
     * Registers JS event handlers that are listed in {@see clientEvents}.
     *
     * @param string $id
     */
    protected function registerClientEvents(string $id): void
    {
        $new = clone $this;

        if ($new->clientEvents) {
            $js = [];

            foreach ($new->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }

            if ($new->webView !== null) {
                $new->webView->registerJs(implode("\n", $js));
            }
        }
    }

    public function assetManager(AssetManager $value): self
    {
        $new = clone $this;
        $new->assetManager = $value;
        return $new;
    }

    /**
     * The event handlers for the underlying Bootstrap JS plugin.
     *
     * Please refer to the corresponding Bootstrap plugin Web page for possible events.
     *
     * For example, [this page](http://getbootstrap.com/javascript/#modals) shows how to use the "Modal" plugin and the
     * supported events (e.g. "shown").
     */
    public function clientEvents(array $value): self
    {
        $new = clone $this;
        $new->clientEvents = $value;
        return $new;
    }

    /**
     * The options for the underlying Bootstrap JS plugin.
     *
     * Please refer to the corresponding Bootstrap plugin Web page for possible options.
     *
     * For example, [this page](http://getbootstrap.com/javascript/#modals) shows how to use the "Modal" plugin and the
     * supported options (e.g. "remote").
     */
    public function clientOptions(array $value): self
    {
        $new = clone $this;
        $new->clientOptions = $value;
        return $new;
    }

    public function getClientOptions(): array
    {
        return $this->clientOptions;
    }

    /**
     * Enable/Disable script Bootstrap JS plugin.
     */
    public function enableClientOptions(bool $value): self
    {
        $new = clone $this;
        $new->enableClientOptions = $value;
        return $new;
    }

    public function getEnableClientOptions(): bool
    {
        return $this->enableClientOptions;
    }

    public function webView(object $value): self
    {
        $new = clone $this;
        $new->webView = $value;
        return $new;
    }
}
