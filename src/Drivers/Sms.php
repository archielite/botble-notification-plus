<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\Contracts\Provider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class Sms implements Provider
{
    public function __construct(
        protected string $apiKey,
        protected string $apiSecret,
        protected string $from,
        protected string $to,
    ) {
        if (empty($this->apiKey) || empty($this->apiSecret) || empty($this->from) || empty($this->to)) {
            throw new InvalidArgumentException('Missing required parameters');
        }
    }

    public function send(string $message): array
    {
        $response = Http::post('https://rest.nexmo.com/sms/json', [
            'api_key' => $this->apiKey,
            'api_secret' => $this->apiSecret,
            'from' => $this->from,
            'to' => $this->to,
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
