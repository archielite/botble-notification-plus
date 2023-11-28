<x-plugins-notification-plus::setting-form
    :$name
    :$driver
    :title="trans('plugins/notification-plus::notification-plus.vonage.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.vonage.settings.description', ['link' => Html::link('https://dashboard.nexmo.com/', 'Nexmo.com', ['target' => '_blank'])])"
>
    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.vonage.settings.api_key')"
        :name="NotificationPlus::getSettingKey($name, 'api_key')"
        :value="NotificationPlus::getSetting($name, 'api_key')"
        :helper-text="trans('plugins/notification-plus::notification-plus.vonage.settings.api_key_instruction')"
    />

    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.vonage.settings.api_secret')"
        :name="NotificationPlus::getSettingKey($name, 'api_secret')"
        :value="NotificationPlus::getSetting($name, 'api_secret')"
    />

    <div class="row">
        <div class="col-md-6">
            <x-core::form.text-input
                :label="trans('plugins/notification-plus::notification-plus.vonage.settings.from')"
                :name="NotificationPlus::getSettingKey($name, 'from')"
                :value="NotificationPlus::getSetting($name, 'from')"
                :helper-text="trans('plugins/notification-plus::notification-plus.vonage.settings.from_instruction')"
            />
        </div>
        <div class="col-md-6">
            <x-core::form.text-input
                :label="trans('plugins/notification-plus::notification-plus.vonage.settings.to')"
                :name="NotificationPlus::getSettingKey($name, 'to')"
                :value="NotificationPlus::getSetting($name, 'to')"
                :helper-text="trans('plugins/notification-plus::notification-plus.vonage.settings.to_instruction')"
            />
        </div>
    </div>
</x-plugins-notification-plus::setting-form>
