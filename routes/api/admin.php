<?php
use  App\Http\Controllers\Api\Admin\{
        BrandController,
        SymbelGroupController,
        TradingGroupController,
        TradingAccountController,
        SymbelSettingController,
        TradeOrderController,
        DataFeedController,
        TickController
    };



Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('/brands',                 BrandController::class);
    Route::apiResource('/trading_accounts',       TradingAccountController::class);
    Route::apiResource('/trading_account_groups', TradingGroupController::class);
    Route::apiResource('/symbel_group',           SymbelGroupController::class);
    Route::apiResource('/symbel_setting',         SymbelSettingController::class);
    Route::apiResource('/trade_orders',           TradeOrderController::class);
    Route::apiResource('/data_feed',              DataFeedController::class);
    Route::apiResource('/ticks',                  TickController::class);
});

