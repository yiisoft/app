<?php

declare(strict_types=1);

return [
    'yiisoft/router-fastroute' => [
        'enableCache' => true,

        /**
         * Yii Framework encodes URLs differently than previous versions. If you are
         * migrating a project from older versions, you can set this value to `false`
         * to keep URLs encoded the same way.
         * Default `true` is RFC3986 compliant
         */
        'encodeRaw' => true,
    ],
];
