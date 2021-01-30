<?php

declare(strict_types=1);

use App\Controller\SiteController;
use Yiisoft\Composer\Config\Merger\Modifier\ReverseBlockMerge;
use Yiisoft\Router\Route;

return [
    Route::get('/', [SiteController::class, 'index'])->name('home'),
    ReverseBlockMerge::class => new ReverseBlockMerge(),
];
