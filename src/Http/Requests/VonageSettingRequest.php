<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use ArchiElite\NotificationPlus\Drivers\Vonage;
use Botble\Base\Facades\BaseHelper;

class VonageSettingRequest extends SettingRequest
{
    public function rules(): array
    {
        return [
            $this->inputKey(Vonage::class, 'api_key') => ['required', 'string'],
            $this->inputKey(Vonage::class, 'api_secret') => ['required', 'string'],
            $this->inputKey(Vonage::class, 'from') => ['required', 'string', BaseHelper::getPhoneValidationRule()],
            $this->inputKey(Vonage::class, 'to') => ['required', 'string', BaseHelper::getPhoneValidationRule()],
        ];
    }

    public function attributes(): array
    {
        return [
            $this->inputKey(Vonage::class, 'api_key') => __('Vonage API Key'),
            $this->inputKey(Vonage::class, 'api_secret') => __('Vonage API Secret'),
            $this->inputKey(Vonage::class, 'from') => __('Vonage From'),
            $this->inputKey(Vonage::class, 'to') => __('Vonage To'),
        ];
    }
}
