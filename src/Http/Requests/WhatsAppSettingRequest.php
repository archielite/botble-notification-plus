<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use ArchiElite\NotificationPlus\Drivers\WhatsApp;
use Botble\Base\Facades\BaseHelper;

class WhatsAppSettingRequest extends SettingRequest
{
    public function rules(): array
    {
        return [
            $this->inputKey(WhatsApp::class, 'phone_number_id') => ['required', 'string', 'min:10'],
            $this->inputKey(WhatsApp::class, 'to_phone_number') => ['required', 'string', BaseHelper::getPhoneValidationRule()],
            $this->inputKey(WhatsApp::class, 'access_token') => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            $this->inputKey(WhatsApp::class, 'phone_number_id') => __('Phone Number ID'),
            $this->inputKey(WhatsApp::class, 'to_phone_number') => __('To Phone Number'),
            $this->inputKey(WhatsApp::class, 'access_token') => __('Access Token'),
        ];
    }
}
