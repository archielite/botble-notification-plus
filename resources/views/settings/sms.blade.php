<x-notification-plus::setting-form
    :$name
    :$driver
    :$validator
    :title="trans('plugins/notification-plus::notification-plus.sms.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.sms.settings.description', ['link' => Html::link('https://dashboard.nexmo.com/', 'Nexmo.com', ['target' => '_blank'])])"
>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_key') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'vonage_api_key') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'vonage_api_key') }}" />
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_key_instruction')) !!}
    </div>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_secret') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'vonage_api_secret') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'vonage_api_secret') }}" />
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.from') }}</label>
                <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'vonage_from') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'vonage_from') }}" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.from_instruction')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.to') }}</label>
                <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'vonage_to') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'vonage_to') }}" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.to_instruction')) !!}
            </div>
        </div>
    </div>
</x-notification-plus::setting-form>
