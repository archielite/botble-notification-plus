<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\AbstractDriver;
use Illuminate\Support\Facades\Http;

class Slack extends AbstractDriver
{
    protected string $viewPath = 'plugins/notification-plus::settings.slack';

    public function send(string $message, array $data = []): array
    {
        if (! $this->isEnabled()) {
            return [
                'success' => false,
                'message' => 'Slack notification is not enabled',
            ];
        }

        if (! $this->getSetting('webhook_url')) {
            return [
                'success' => false,
                'message' => 'Webhook URL is not set',
            ];
        }

        $response = Http::asJson()->post($this->getSetting('webhook_url'), $data);

        if ($response->failed()) {
            return [
                'success' => false,
                'message' => $response->reason() ?: $response->body(),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
