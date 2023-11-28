<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\AbstractDriver;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Vonage extends AbstractDriver
{
    protected string $viewPath = 'plugins/notification-plus::settings.vonage';

    public function send(string $message, array $data = []): array
    {
        if (! $this->isEnabled()) {
            return [
                'success' => false,
                'message' => 'Vonage is not enabled',
            ];
        }

        $apiKey = $this->getSetting('api_key');
        $apiSecret = $this->getSetting('api_secret');
        $from = $this->getSetting('from');
        $to = $this->getSetting('to');

        if (! $apiKey || ! $apiSecret || ! $from || ! $to) {
            return [
                'success' => false,
                'message' => 'Vonage is not configured',
            ];
        }

        $response = Http::post('https://rest.nexmo.com/sms/json', [
            'api_key' => $apiKey,
            'api_secret' => $apiSecret,
            'from' => $from,
            'to' => $to,
            'text' => $message,
        ]);

        if (Arr::get($response->json('data'), 'messages.0.status') != 0) {
            return [
                'success' => false,
                'message' => Arr::get($response->json('data'), 'messages.0.error-text'),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
