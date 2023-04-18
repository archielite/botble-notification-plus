<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TelegramSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'ae_notification_plus_telegram_bot_token' => ['required', 'string'],
            'ae_notification_plus_telegram_chat_id' => [
                Rule::requiredIf(fn () => $this->input('ae_notification_plus_telegram_bot_token') !== ''),
                'string'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'ae_notification_plus_telegram_bot_token' => __('Telegram Bot Token'),
            'ae_notification_plus_telegram_chat_id' => __('Telegram Chat ID'),
        ];
    }
}
