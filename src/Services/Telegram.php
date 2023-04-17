<?php

namespace ArchiElite\NotificationPlus\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Telegram
{
    protected const API_URL = 'https://api.telegram.org/bot';

    public function getUpdates(array $params = []): array
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

    public function sendMessage(string $message): array
    {
        $response = $this->request('POST', 'sendMessage', [
            'chat_id' => setting('notification_telegram_chat_id'),
            'text' => $message,
        ]);

        return $response->json();
    }

    protected function request(string $method, string $uri, array $data = []): Response
    {
        $botToken = setting('notification_telegram_bot_token');

        return match (strtoupper($method)) {
            'POST' => Http::post(self::API_URL . $botToken . '/' . $uri, $data),
            default => Http::get(self::API_URL . $botToken . '/' . $uri, $data),
        };
    }
}
