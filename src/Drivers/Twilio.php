<?php

namespace ArchiElite\NotificationPlus\Drivers;

use ArchiElite\NotificationPlus\AbstractDriver;
use Illuminate\Support\Facades\Http;

class Twilio extends AbstractDriver
{
    protected const API_URL = 'https://api.twilio.com/2010-04-01';

    protected string $viewPath = 'plugins/notification-plus::settings.twilio';

    public function send(string $message, array $data = []): array
    {
        if (! $this->isEnabled()) {
            return [
                'success' => false,
                'message' => 'Twilio is not enabled',
            ];
        }

        $sid = $this->getSetting('account_sid');
        $authToken = $this->getSetting('auth_token');
        $from = $this->getSetting('from');
        $to = $this->getSetting('to');

        if (! $sid || ! $authToken || ! $from || ! $to) {
            return [
                'success' => false,
                'message' => 'Twilio is not configured',
            ];
        }

        $response = Http::asForm()->withBasicAuth($sid, $authToken)->post(self::API_URL . "/Accounts/$sid/Messages.json", [
            'From' => $from,
            'To' => $to,
            'Body' => $message,
        ]);

        if ($response->json('error_code')) {
            return [
                'success' => false,
                'message' => $response->json('error_message'),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
