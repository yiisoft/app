<?php

declare(strict_types=1);

use Yiisoft\Yii\Debug\Viewer\Panels\PanelCollection;

/** @var array $params */

return [
    PanelCollection::class => [
        '__construct()' => [$params['yiisoft/yii-debug-viewer']['panels']],
    ]
];
