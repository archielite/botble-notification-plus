<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\AbstractDriver;
use Illuminate\Support\Facades\Http;

class WhatsApp extends AbstractDriver
{
    protected string $viewPath = 'plugins/notification-plus::settings.whatsapp';

    public function send(string $message, array $data = []): array
    {
        if (! $this->isEnabled()) {
            return [
                'success' => false,
                'message' => 'WhatsApp notification is not enabled',
            ];
        }

        if (! $this->getSetting('access_token')) {
            return [
                'success' => false,
                'message' => 'Access token is not set',
            ];
        }

        if (! $this->getSetting('phone_number_id') || ! $this->getSetting('to_phone_number')) {
            return [
                'success' => false,
                'message' => 'Phone number ID or to phone number is not set',
            ];
        }

        $response = Http::asJson()
            ->withToken($this->getSetting('access_token'))
            ->post("https://graph.facebook.com/v16.0/{$this->getSetting('phone_number_id')}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $this->getSetting('to_phone_number'),
                'type' => 'text',
                'text' => [
                    'body' => $message,
                ],
            ]);

        if ($response->json('error')) {
            return [
                'success' => false,
                'message' => $response->json('error.message'),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
