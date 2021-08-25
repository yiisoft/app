<?php

declare(strict_types=1);

use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsHtml;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Yii\Debug\Viewer\IndexController;
use Yiisoft\Yii\Debug\Viewer\Panels\ConfigController;
use Yiisoft\Yii\Debug\Viewer\Panels\Info\PanelInfoController;
use Yiisoft\Yii\Debug\Viewer\Panels\Routes\PanelRoutesController;
use Yiisoft\Yii\Debug\Viewer\Panels\Logs\PanelLogsController;
use Yiisoft\Yii\Debug\Viewer\Panels\Events\PanelEventsController;
use Yiisoft\Yii\Debug\Viewer\Panels\Services\PanelServicesController;

return [
    Route::get('/debug/viewer[/]')
        ->middleware(FormatDataResponseAsHtml::class)
        ->action([IndexController::class, 'index'])
        ->name('debug/panels/index'),
    Group::create('/debug/panels')
        ->middleware(FormatDataResponseAsHtml::class)
        ->middleware(CorsMiddleware::class)
        ->routes(
            Route::get('/config')
                ->middleware(FormatDataResponseAsJson::class)
                ->action([ConfigController::class, 'index'])
                ->name('debug/panels/config'),
            Route::get('/info')
                ->action([PanelInfoController::class, 'view'])
                ->name('debug/panels/info'),
            Route::get('/routes')
                ->action([PanelRoutesController::class, 'view'])
                ->name('debug/panels/routes'),
			Route::get('/logs')
                ->action([PanelLogsController::class, 'view'])
                ->name('debug/panels/logs'),
            Route::get('/events')
                ->action([PanelEventsController::class, 'view'])
                ->name('debug/panels/events'),
            Route::get('/services')
                ->action([PanelServicesController::class, 'view'])
                ->name('debug/panels/services')
        ),
];
