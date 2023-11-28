<?php

namespace ArchiElite\NotificationPlus\Http\Requests\Settings;

use ArchiElite\NotificationPlus\Drivers\Slack;
use ArchiElite\NotificationPlus\Drivers\Telegram;
use ArchiElite\NotificationPlus\Drivers\Twilio;
use ArchiElite\NotificationPlus\Drivers\Vonage;
use ArchiElite\NotificationPlus\Drivers\WhatsApp;
use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use Botble\Base\Facades\BaseHelper;
use Botble\Support\Http\Requests\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NotificationPlusSettingRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            ...$this->getSlackValidation(),
            ...$this->getTelegramValidation(),
            ...$this->getTwilioValidation(),
            ...$this->getVonageValidation(),
            ...$this->getWhatsAppValidation(),
        ];

        return apply_filters('notification-plus-settings-validation-rules', $rules);
    }

    public function getSlackValidation(): array
    {
        if (! $this->boolean($this->inputKey(Slack::class, 'enable'))) {
            return [];
        }

        return [
            $this->inputKey(Slack::class, 'webhook_url') => ['required', 'string', 'url'],
        ];
    }

    public function getTelegramValidation(): array
    {
        if (! $this->boolean($this->inputKey(Telegram::class, 'enable'))) {
            return [];
        }

        return [
            $this->inputKey(Telegram::class, 'bot_token') => ['required', 'string'],
            $this->inputKey(Telegram::class, 'chat_id') => [
                Rule::requiredIf($this->inputKey(Telegram::class, 'bot_token') !== ''),
                'string',
            ],
        ];
    }

    public function getTwilioValidation(): array
    {
        if (! $this->boolean($this->inputKey(Twilio::class, 'enable'))) {
            return [];
        }

        return [
            $this->inputKey(Twilio::class, 'account_sid') => ['required', 'string'],
            $this->inputKey(Twilio::class, 'auth_token') => ['required', 'string'],
            $this->inputKey(Twilio::class, 'from') => ['required', 'string', ...$this->getPhoneValidation()],
            $this->inputKey(Twilio::class, 'to') => ['required', 'string', ...$this->getPhoneValidation()],
        ];
    }

    public function getVonageValidation(): array
    {
        if (! $this->boolean($this->inputKey(Vonage::class, 'enable'))) {
            return [];
        }

        return [
            $this->inputKey(Vonage::class, 'api_key') => ['required', 'string'],
            $this->inputKey(Vonage::class, 'api_secret') => ['required', 'string'],
            $this->inputKey(Vonage::class, 'from') => ['required', 'string', ...$this->getPhoneValidation()],
            $this->inputKey(Vonage::class, 'to') => ['required', 'string', ...$this->getPhoneValidation()],
        ];
    }

    public function getWhatsAppValidation(): array
    {
        if (! $this->boolean($this->inputKey(WhatsApp::class, 'enable'))) {
            return [];
        }

        return [
            $this->inputKey(WhatsApp::class, 'phone_number_id') => ['required', 'string', 'min:10'],
            $this->inputKey(WhatsApp::class, 'to_phone_number') => ['required', 'string', ...$this->getPhoneValidation()],
            $this->inputKey(WhatsApp::class, 'access_token') => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        $attributes = [
            $this->inputKey(Slack::class, 'webhook_url') => __('Slack Webhook URL'),
            $this->inputKey(Telegram::class, 'bot_token') => __('Telegram Bot Token'),
            $this->inputKey(Telegram::class, 'chat_id') => __('Telegram Chat ID'),
            $this->inputKey(Twilio::class, 'account_sid') => __('Twilio Account SID'),
            $this->inputKey(Twilio::class, 'auth_token') => __('Twilio Auth Token'),
            $this->inputKey(Twilio::class, 'from') => __('Twilio From'),
            $this->inputKey(Twilio::class, 'to') => __('Twilio To'),
            $this->inputKey(Vonage::class, 'api_key') => __('Vonage API Key'),
            $this->inputKey(Vonage::class, 'api_secret') => __('Vonage API Secret'),
            $this->inputKey(Vonage::class, 'from') => __('Vonage From'),
            $this->inputKey(Vonage::class, 'to') => __('Vonage To'),
            $this->inputKey(WhatsApp::class, 'phone_number_id') => __('Phone Number ID'),
            $this->inputKey(WhatsApp::class, 'to_phone_number') => __('To Phone Number'),
            $this->inputKey(WhatsApp::class, 'access_token') => __('Access Token'),
        ];

        return apply_filters('notification-plus-settings-validation-attributes', $attributes);
    }

    protected function inputKey(string $driver, string $key): string
    {
        $settingKey = NotificationPlus::getSettingKey(Str::slug(Str::snake($driver)), $key);

        return str_replace(['[', ']', '[]'], ['.', '', ''], $settingKey);
    }

    protected function getPhoneValidation(): array
    {
        return explode('|', BaseHelper::getPhoneValidationRule());
    }
}
