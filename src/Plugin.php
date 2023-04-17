<?php

namespace ArchiElite\NotificationPlus;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Botble\Setting\Models\Setting;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Setting::query()
            ->where('key', 'LIKE', 'ae_notification_plus_%')
            ->delete();
    }
}
