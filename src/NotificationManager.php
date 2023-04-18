<?php

namespace ArchiElite\NotificationPlus;

use ArchiElite\NotificationPlus\Contracts\NotificationManager as NotificationManagerContract;

class NotificationManager implements NotificationManagerContract
{
    protected array $drivers = [];

    public function register(string $driver): void
    {
        $this->drivers[] = $driver;
    }

    public function driver(string $driver): AbstractDriver
    {
        return app($driver);
    }

    public function sendNotifications(string $message): void
    {
        foreach ($this->drivers as $driver) {
            $this->driver($driver)->send($message);
        }
    }

    public function getSetting(string $driver, string $key, string|null|bool $default = null): string|null
    {
        return setting('ae_notification_plus_' . $driver . '_' . $key, $default);
    }

    public function getSettingKey(string $driver, string $key): string
    {
        return 'ae_notification_plus[' . $driver . '][' . $key . ']';
    }

    public function settings(): string
    {
        $html = '';

        foreach ($this->drivers as $driver) {
            $html .= $this->driver($driver)->settings();
        }

        return $html;
    }

    public function getAvailableDrivers(): array
    {
        return $this->drivers;
    }
}
