<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\AbstractDriver;
use ArchiElite\NotificationPlus\Http\Requests\SmsSettingRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Sms extends AbstractDriver
{
    protected string $validatorClass = SmsSettingRequest::class;

    protected string $viewPath = 'plugins/notification-plus::settings.sms';

    public function send(string $message): array
    {
        if (! $this->isEnabled()) {
            return [
                'success' => false,
                'message' => 'SMS is not enabled',
            ];
        }

        if (! $this->getSetting('api_key') || ! $this->getSetting('api_secret')) {
            return [
                'success' => false,
                'message' => 'API key or secret is not set',
            ];
        }

        if (! $this->getSetting('from') || ! $this->getSetting('to')) {
            return [
                'success' => false,
                'message' => 'From or to is not set',
            ];
        }

        $response = Http::post('https://rest.nexmo.com/sms/json', [
            'api_key' => $this->getSetting('api_key'),
            'api_secret' => $this->getSetting('api_secret'),
            'from' => $this->getSetting('from'),
            'to' => $this->getSetting('to'),
            'text' => $message,
        ]);

        $data = $response->json();

        if (Arr::get($data, 'messages.0.status') != 0) {
            return [
                'success' => false,
                'message' => Arr::get($data, 'messages.0.error-text'),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
