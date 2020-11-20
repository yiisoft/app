<?php

declare(strict_types=1);

use App\Contact\ContactMailer;

/**  @var array $params */

return [
    ContactMailer::class => [
        '__class' => ContactMailer::class,
        '__construct()' => [
            'to' => $params['mailer']['adminEmail'],
        ],
    ],
];
