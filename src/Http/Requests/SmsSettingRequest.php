<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use Botble\Support\Http\Requests\Request;

class SmsSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'ae_notification_plus_sms_vonage_api_key' => ['required', 'string'],
            'ae_notification_plus_sms_vonage_api_secret' => ['required', 'string'],
            'ae_notification_plus_sms_vonage_from' => ['required', 'string'],
            'ae_notification_plus_sms_vonage_to' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'ae_notification_plus_sms_vonage_api_key' => __('Vonage API Key'),
            'ae_notification_plus_sms_vonage_api_secret' => __('Vonage API Secret'),
            'ae_notification_plus_sms_vonage_from' => __('Vonage From'),
            'ae_notification_plus_sms_vonage_to' => __('Vonage To'),
        ];
    }
}
