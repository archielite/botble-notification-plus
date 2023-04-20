<x-notification-plus::setting-form
    :$name
    :$driver
    :$validator
    :title="trans('plugins/notification-plus::notification-plus.whatsapp.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.whatsapp.settings.description', ['link' => Html::link('https://developers.facebook.com/apps', 'Facebook Developer', ['target' => '_blank'])->toHtml()])"
>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.phone_number_id') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'phone_number_id') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'phone_number_id') }}" placeholder="10xxxxxxxxxxxxxx" />
    </div>

    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.access_token') }}</label>
        <input type="password" name="{{ NotificationPlus::getSettingKey($name, 'access_token') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'access_token') }}" placeholder="EAA..." />
    </div>

    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'to_phone_number') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'to_phone_number') }}" placeholder="84xxxxxxxx" />
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number_instruction')) !!}
        {!! Form::helper(__('If you don\'t have received any message from the bot, please reply to the message from the bot with any word to mark it as not spam.')) !!}
    </div>
</x-notification-plus::setting-form>
