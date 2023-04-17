<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\Contracts\Provider;
use ArchiElite\NotificationPlus\Services\Telegram as TelegramService;
use Illuminate\Support\Arr;

class Telegram implements Provider
{
    public function __construct(protected TelegramService $telegramService)
    {
    }

    public function send(string $message): array
    {
        $data = $this->telegramService->sendMessage($message);

        if (Arr::get($data, 'ok') !== true) {
            return [
                'success' => false,
                'message' => Arr::get($data, 'description'),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
