<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseFactoryInterface;
use Tuupola\Middleware\CorsMiddleware;
use Yiisoft\DataResponse\Middleware\FormatDataResponseAsJson;
use Yiisoft\Http\Method;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Yiisoft\Validator\Rule\Ip;
use Yiisoft\Yii\Debug\Api\Controller\DebugController;
use Yiisoft\Yii\Debug\Api\Middleware\ResponseDataWrapper;
use Yiisoft\Yii\Web\Middleware\IpFilter;

if (!(bool)($params['yiisoft/yii-debug-api']['enabled'] ?? false)) {
    return [];
}

return [
    Group::create('/debug')
        ->middleware(CorsMiddleware::class)
        ->middleware(
            static function (ResponseFactoryInterface $responseFactory) use ($params) {
                return new IpFilter(
                    Ip::rule()->ranges($params['yiisoft/yii-debug-api']['allowedIPs']),
                    $responseFactory
                );
            }
        )
        ->middleware(FormatDataResponseAsJson::class)
        ->middleware(ResponseDataWrapper::class)
        ->routes(
            Route::methods([Method::GET, Method::OPTIONS], '[/]')
                ->action([DebugController::class, 'index'])
                ->name('debug/index'),
            Route::methods([Method::GET, Method::OPTIONS], '/summary/{id}')
                ->action([DebugController::class, 'summary'])
                ->name('debug/summary'),
            Route::methods([Method::GET, Method::OPTIONS], '/view/{id}[/{collector}]')
                ->action([DebugController::class, 'view'])
                ->name('debug/view'),
            Route::methods([Method::GET, Method::OPTIONS], '/dump/{id}[/{collector}]')
                ->action([DebugController::class, 'dump'])
                ->name('debug/dump'),
            Route::methods([Method::GET, Method::OPTIONS], '/object/{id}/{objectId}')
                ->action([DebugController::class, 'object'])
                ->name('debug/object')
        ),
];
