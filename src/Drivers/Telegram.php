<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\AbstractDriver;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Telegram extends AbstractDriver
{
    protected const API_URL = 'https://api.telegram.org/bot';

    protected string $viewPath = 'plugins/notification-plus::settings.telegram';

    public function send(string $message, array $data = []): array
    {
        if (! $this->isEnabled()) {
            return [
                'success' => false,
                'message' => 'Telegram is not enabled',
            ];
        }

        if (! $this->getSetting('bot_token') || ! $this->getSetting('chat_id')) {
            return [
                'success' => false,
                'message' => 'Bot token or chat id is not set',
            ];
        }

        $response = $this->sendMessage($message);

        if (Arr::get($response, 'ok') !== true) {
            return [
                'success' => false,
                'message' => Arr::get($response, 'description'),
            ];
        }

        return [
            'success' => true,
        ];
    }

    protected function getUpdates(array $params = []): array
    {
        $response = $this->request('GET', 'getUpdates', $params);

        return $response->json();
    }

    public function getChatIds(): array
    {
        $updates = $this->getUpdates();

        $chats = [];

        foreach (Arr::get($updates, 'result', []) as $update) {
            $chat = Arr::get($update, 'message.chat', []);

            if (empty($chat)) {
                continue;
            }

            $chats[$chat['id']] = $chat['title'];
        }

        return $chats;
    }

    protected function sendMessage(string $message): array
    {
        $response = $this->request('POST', 'sendMessage', [
            'chat_id' => $this->getSetting('chat_id'),
            'text' => $message,
            'parse_mode' => 'HTML',
        ]);

        if (! $response->json('ok')) {
            logger()->error($response->json());
        }

        return $response->json();
    }

    protected function request(string $method, string $uri, array $data = []): Response
    {
        $botToken = $this->getSetting('bot_token');

        return match (strtoupper($method)) {
            'POST' => Http::post(self::API_URL . $botToken . '/' . $uri, $data),
            default => Http::get(self::API_URL . $botToken . '/' . $uri, $data),
        };
    }
}
