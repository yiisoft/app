<?php

declare(strict_types=1);

use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return [
    Group::create()
        ->routes(
            Route::get('/')
                ->action(\App\Controller\HomePage\Action::class)
                ->name('home'),
        ),
];
