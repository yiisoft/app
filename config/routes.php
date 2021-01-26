<?php

declare(strict_types=1);

use App\Controller\SiteController;
use Yiisoft\Arrays\Collection\ArrayCollection;
use Yiisoft\Arrays\Collection\Modifier\SaveOrder;
use Yiisoft\Router\Route;

return new ArrayCollection(
    [
        Route::get('/', [SiteController::class, 'index'])->name('home'),
    ],
    new SaveOrder()
);
