<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\Message\Php\MessageSource;
use Yiisoft\Translator\MessageFormatterInterface;

/** @var array $params */

return [
    // Configure application CategorySource
    'translation.app' => static function (Aliases $aliases, MessageFormatterInterface $messageFormatter) use ($params) {
        $messageSource = new MessageSource($aliases->get('@messages'));

        return new CategorySource(
            $params['yiisoft/translator']['defaultCategory'],
            $messageSource,
            $messageFormatter,
        );
    },
];
