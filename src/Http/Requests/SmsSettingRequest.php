<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use ArchiElite\NotificationPlus\Drivers\Sms;

class SmsSettingRequest extends SettingRequest
{
    public function rules(): array
    {
        return [
            $this->inputKey(Sms::class, 'vonage_api_key') => ['required', 'string'],
            $this->inputKey(Sms::class, 'vonage_api_secret') => ['required', 'string'],
            $this->inputKey(Sms::class, 'vonage_from') => ['required', 'string'],
            $this->inputKey(Sms::class, 'vonage_to') => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            $this->inputKey(Sms::class, 'vonage_api_key') => __('Vonage API Key'),
            $this->inputKey(Sms::class, 'vonage_api_secret') => __('Vonage API Secret'),
            $this->inputKey(Sms::class, 'vonage_from') => __('Vonage From'),
            $this->inputKey(Sms::class, 'vonage_to') => __('Vonage To'),
        ];
    }
}
