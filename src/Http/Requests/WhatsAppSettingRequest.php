<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use Botble\Support\Http\Requests\Request;

class WhatsAppSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'ae_notification_plus_whatsapp_phone_number_id' => ['required', 'string'],
            'ae_notification_plus_whatsapp_to_phone_number' => ['required', 'string'],
            'ae_notification_plus_whatsapp_access_token' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'ae_notification_plus_whatsapp_phone_number_id' => __('Phone Number ID'),
            'ae_notification_plus_whatsapp_to_phone_number' => __('To Phone Number'),
            'ae_notification_plus_whatsapp_access_token' => __('Access Token'),
        ];
    }
}
