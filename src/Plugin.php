<?php

namespace ArchiElite\NotificationPlus;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Botble\Setting\Models\Setting;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Setting::query()
            ->whereIn('key', [
                'telegram_notification_enabled',
                'telegram_bot_token',
                'telegram_channel_id',
            ])->delete();
    }
}
