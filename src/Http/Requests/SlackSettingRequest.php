<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use ArchiElite\NotificationPlus\Drivers\Slack;

class SlackSettingRequest extends SettingRequest
{
    public function rules(): array
    {
        return [
            $this->inputKey(Slack::class, 'webhook_url') => ['required', 'string', 'url'],
        ];
    }

    public function attributes(): array
    {
        return [
            $this->inputKey(Slack::class, 'webhook_url') => __('Slack Webhook URL'),
        ];
    }
}
