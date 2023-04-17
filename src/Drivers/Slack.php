<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\Contracts\Provider;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class Slack implements Provider
{
    public function __construct(protected string $webhookUrl)
    {
        if (empty($this->webhookUrl)) {
            throw new InvalidArgumentException('Webhook URL is required');
        }
    }

    public function send(string $message): array
    {
        $response = Http::asJson()->post($this->webhookUrl, [
            'text' => $message,
        ]);

        if ($response->body() !== 'ok') {
            return [
                'success' => false,
                'message' => $response->reason(),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
