<?php

declare(strict_types=1);

use App\Contact\ContactController;
use App\Controller\SiteController;
use Yiisoft\Http\Method;
use Yiisoft\Router\Route;

return [
    Route::get('/', [SiteController::class, 'index'])->name('site/index'),
    Route::get('/about', [SiteController::class, 'about'])->name('site/about'),
    Route::methods([Method::GET, Method::POST], '/contact', [ContactController::class, 'contact'])
        ->name('contact/form'),
];
