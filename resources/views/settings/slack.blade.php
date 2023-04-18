<x-notification-plus::setting-form
    driver="slack"
    :title="trans('plugins/notification-plus::notification-plus.slack.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.slack.settings.description', ['link' => Html::link('https://api.slack.com/messaging/webhooks', 'tutorial', ['target' => '_blank'])])"
    :validator="\ArchiElite\NotificationPlus\Http\Requests\SlackSettingRequest::class"
>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url') }}</label>
        <input type="text" name="ae_notification_plus[slack_webhook_url]" class="next-input" value="{{ setting('ae_notification_plus_slack_webhook_url') }}" placeholder="E.g: https://hooks.slack.com/services/XXXXXXXXX/XXXXXXXXX/XXXXXXXXXXXXXXXXXXXXXXXX">
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])) !!}
    </div>
</x-notification-plus::setting-form>
