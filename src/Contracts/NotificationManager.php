<?php

namespace ArchiElite\NotificationPlus\Contracts;

use ArchiElite\NotificationPlus\AbstractDriver;

interface NotificationManager
{
    public function register(string $driver): void;

    public function driver(string $driver): AbstractDriver;

    public function getSetting(string $driver, string $key, string|null|bool $default = null): string|null;

    public function getSettingKey(string $driver, string $key): string;

    public function settings(): string;

    public function getAvailableDrivers(): array;
}
