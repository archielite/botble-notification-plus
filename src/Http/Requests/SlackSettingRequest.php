<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use Botble\Support\Http\Requests\Request;

class SlackSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'ae_notification_plus.slack_webhook_url' => ['required', 'string', 'url'],
        ];
    }

    public function attributes(): array
    {
        return [
            'ae_notification_plus.slack_webhook_url' => __('Slack Webhook URL'),
        ];
    }
}
