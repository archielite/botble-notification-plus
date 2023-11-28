<x-plugins-notification-plus::setting-form
    :$name
    :$driver
    :title="trans('plugins/notification-plus::notification-plus.whatsapp.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.whatsapp.settings.description', ['link' => Html::link('https://developers.facebook.com/apps', 'Facebook Developer', ['target' => '_blank'])->toHtml()])"
>
    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.whatsapp.settings.phone_number_id')"
        :name="NotificationPlus::getSettingKey($name, 'phone_number_id')"
        :value="NotificationPlus::getSetting($name, 'phone_number_id')"
        placeholder="10xxxxxxxxxxxxxx"
    />

    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.whatsapp.settings.access_token')"
        :name="NotificationPlus::getSettingKey($name, 'access_token')"
        :value="NotificationPlus::getSetting($name, 'access_token')"
        placeholder="EAA..."
    />

    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number')"
        :name="NotificationPlus::getSettingKey($name, 'to_phone_number')"
        :value="NotificationPlus::getSetting($name, 'to_phone_number')"
        placeholder="84xxxxxxxx"
        :helper-text="trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number_instruction')"
    />

    <x-core::alert>
        {{ __('If you don\'t have received any message from the bot, please reply to the message from the bot with any word to mark it as not spam.') }}
    </x-core::alert>
</x-plugins-notification-plus::setting-form>
