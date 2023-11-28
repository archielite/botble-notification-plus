<?php

use ArchiElite\NotificationPlus\Http\Controllers\Settings\NotificationPlusSettingController;
use Botble\Base\Facades\AdminHelper;

AdminHelper::registerRoutes(function () {
    Route::group([
        'prefix' => 'settings/notification-plus',
        'as' => 'notification-plus.',
        'permission' => 'notification-plus.settings'
    ], function () {
        Route::post('send-test-message', [NotificationPlusSettingController::class, 'sendTestMessage'])
            ->name('send-test-message');
        Route::post('get-telegram-chat-ids', [NotificationPlusSettingController::class, 'getTelegramChatIds'])
            ->name('get-telegram-chat-ids');

        Route::get('/', [NotificationPlusSettingController::class, 'edit'])->name('settings');
        Route::put('/', [NotificationPlusSettingController::class, 'update'])->name('settings.update');
    });
});
