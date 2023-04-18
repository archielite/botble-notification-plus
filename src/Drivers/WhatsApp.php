<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\Contracts\Provider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class WhatsApp implements Provider
{
    public function __construct(
        protected string $phoneNumberId,
        protected string $toPhoneNumber,
        protected string $accessToken,
    ) {
        if (isset($this->phoneNumberId) || isset($this->toPhoneNumber) || isset($this->accessToken)) {
            throw new InvalidArgumentException('Missing required parameters');
        }
    }

    public function send(string $message): array
    {
        $response = Http::asJson()
            ->withToken(setting('ae_notification_plus_whatsapp_access_token'))
            ->post("https://graph.facebook.com/v16.0/$this->phoneNumberId/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $this->toPhoneNumber,
                'type' => 'text',
                'text' => [
                    'body' => $message,
                ],
            ]);

        $data = $response->json();

        if (Arr::has($data, 'error')) {
            return [
                'success' => false,
                'message' => Arr::get($data, 'error.message'),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
