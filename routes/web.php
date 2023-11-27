<?php

use Botble\Base\Facades\BaseHelper;
use ArchiElite\NotificationPlus\Http\Controllers\SettingController;
use ArchiElite\NotificationPlus\Http\Controllers\Settings\NotificationPlusSettingController;

Route::prefix(BaseHelper::getAdminPrefix())->middleware(['web', 'core', 'auth'])->group(function () {
    Route::group([
        'prefix' => 'settings/notification-plus',
        'as' => 'notification-plus.',
        'permission' => 'notification-plus.settings'
    ], function () {
        Route::post('send-test-message', [SettingController::class, 'sendTestMessage'])->name('send-test-message');
        Route::post('get-telegram-chat-ids', [SettingController::class, 'getTelegramChatIds'])->name('get-telegram-chat-ids');

        Route::get('/', [NotificationPlusSettingController::class, 'edit'])->name('settings');
        Route::put('/', [NotificationPlusSettingController::class, 'update'])->name('settings.update');
    });
});
