<?php

namespace ArchiElite\NotificationPlus\Facades;

use ArchiElite\NotificationPlus\Contracts\NotificationManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void register(string $driver)
 * @method static \ArchiElite\NotificationPlus\AbstractDriver driver(string $driver)
 * @method static string|null getSetting(string $driver, string $key, string|bool|null $default = null)
 * @method static string getSettingKey(string $driver, string $key)
 * @method static string settings()
 * @method static array getAvailableDrivers()
 *
 * @see \ArchiElite\NotificationPlus\NotificationManager
 */
class NotificationPlus extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NotificationManager::class;
    }
}
