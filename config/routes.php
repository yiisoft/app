<?php

declare(strict_types=1);

use App\Controller\SiteController;
use Yiisoft\Arrays\Modifier\ReverseBlockMerge;
use Yiisoft\Router\Route;

return [
    Route::get('/', [SiteController::class, 'index'])->name('site/index'),
    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
