<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use ArchiElite\NotificationPlus\Drivers\Telegram;
use Illuminate\Validation\Rule;

class TelegramSettingRequest extends SettingRequest
{
    public function rules(): array
    {
        return [
            $this->inputKey(Telegram::class, 'bot_token') => ['required', 'string'],
            $this->inputKey(Telegram::class, 'chat_id') => [
                Rule::requiredIf(fn () => $this->inputKey(Telegram::class, 'bot_token') !== ''),
                'string',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            $this->inputKey(Telegram::class, 'bot_token') => __('Telegram Bot Token'),
            $this->inputKey(Telegram::class, 'chat_id') => __('Telegram Chat ID'),
        ];
    }
}
