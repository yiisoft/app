<?php

declare(strict_types=1);

use App\Controller\SiteController;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;

return [
    Group::create('/{_language}')
        ->routes(
            Route::get('/')->action([SiteController::class, 'index'])->name('home'),
        ),
];
