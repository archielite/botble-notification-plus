<?php

namespace ArchiElite\NotificationPlus\Facades;

use ArchiElite\NotificationPlus\Contracts\Factory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \ArchiElite\NotificationPlus\Contracts\Provider driver(string $driver = null)
 *
 * @see \ArchiElite\NotificationPlus\NotificationManager
 */
class Notification extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Factory::class;
    }
}
