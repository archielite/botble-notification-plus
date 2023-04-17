<?php

use Botble\Base\Facades\BaseHelper;
use ArchiElite\NotificationPlus\Http\Controllers\SettingController;

Route::prefix(BaseHelper::getAdminPrefix())->middleware(['web', 'core', 'auth'])->group(function () {
    Route::prefix('notification-plus')->name('notification-plus.')->group(function () {
        Route::group(['permission' => 'notification-plus.settings'], function () {
            Route::get('settings', [SettingController::class, 'index'])->name('settings');
            Route::post('settings', [SettingController::class, 'save']);
            Route::post('send-test-message', [SettingController::class, 'sendTestMessage'])->name('send-test-message');
            Route::post('get-telegram-chat-ids', [SettingController::class, 'getTelegramChatIds'])->name('get-telegram-chat-ids');
        });
    });
});
