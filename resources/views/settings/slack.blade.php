<x-plugins-notification-plus::setting-form
    :$name
    :$driver
    :title="trans('plugins/notification-plus::notification-plus.slack.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.slack.settings.description', ['link' => Html::link('https://api.slack.com/messaging/webhooks', 'tutorial', ['target' => '_blank'])])"
>
    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url')"
        :name="NotificationPlus::getSettingKey($name, 'webhook_url')"
        :value="NotificationPlus::getSetting($name, 'webhook_url')"
        placeholder="E.g: https://hooks.slack.com/services/XXXXXXXXX/XXXXXXXXX/XXXXXXXXXXXXXXXXXXXXXXXX"
        class="js-telegram-bot-token"
        :helper-text="trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])"
    />
</x-plugins-notification-plus::setting-form>
