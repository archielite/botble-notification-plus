<x-plugins-notification-plus::setting-form
    :$name
    :$driver
    :title="trans('plugins/notification-plus::notification-plus.twilio.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.twilio.settings.description', ['link' => Html::link('https://www.twilio.com', 'Twilio.com', ['target' => '_blank'])])"
>
    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.twilio.settings.account_sid')"
        :name="NotificationPlus::getSettingKey($name, 'account_sid')"
        :value="NotificationPlus::getSetting($name, 'account_sid')"
        placeholder="E.g: https://hooks.slack.com/services/XXXXXXXXX/XXXXXXXXX/XXXXXXXXXXXXXXXXXXXXXXXX"
        :helper-text="trans('plugins/notification-plus::notification-plus.twilio.settings.account_sid_instruction')"
    />

    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.twilio.settings.auth_token')"
        :name="NotificationPlus::getSettingKey($name, 'auth_token')"
        :value="NotificationPlus::getSetting($name, 'auth_token')"
    />

    <div class="row">
        <div class="col-md-6">
            <x-core::form.text-input
                :label="trans('plugins/notification-plus::notification-plus.twilio.settings.from')"
                :name="NotificationPlus::getSettingKey($name, 'from')"
                :value="NotificationPlus::getSetting($name, 'from')"
                :helper-text="trans('plugins/notification-plus::notification-plus.twilio.settings.from_instruction')"
            />
        </div>
        <div class="col-md-6">
            <x-core::form.text-input
                :label="trans('plugins/notification-plus::notification-plus.twilio.settings.to')"
                :name="NotificationPlus::getSettingKey($name, 'to')"
                :value="NotificationPlus::getSetting($name, 'to')"
                :helper-text="trans('plugins/notification-plus::notification-plus.twilio.settings.to_instruction')"
            />
        </div>
    </div>
</x-plugins-notification-plus::setting-form>
