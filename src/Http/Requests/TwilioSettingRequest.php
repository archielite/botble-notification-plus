<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use ArchiElite\NotificationPlus\Drivers\Twilio;
use Botble\Base\Facades\BaseHelper;

class TwilioSettingRequest extends SettingRequest
{
    public function rules(): array
    {
        return [
            $this->inputKey(Twilio::class, 'account_sid') => ['required', 'string'],
            $this->inputKey(Twilio::class, 'auth_token') => ['required', 'string'],
            $this->inputKey(Twilio::class, 'from') => ['required', 'string', BaseHelper::getPhoneValidationRule()],
            $this->inputKey(Twilio::class, 'to') => ['required', 'string', BaseHelper::getPhoneValidationRule()],
        ];
    }

    public function attributes(): array
    {
        return [
            $this->inputKey(Twilio::class, 'account_sid') => __('Twilio Account SID'),
            $this->inputKey(Twilio::class, 'auth_token') => __('Twilio Auth Token'),
            $this->inputKey(Twilio::class, 'from') => __('Twilio From'),
            $this->inputKey(Twilio::class, 'to') => __('Twilio To'),
        ];
    }
}
