<x-notification-plus::setting-form
    :$name
    :$driver
    :$validator
    :title="trans('plugins/notification-plus::notification-plus.twilio.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.twilio.settings.description', ['link' => Html::link('https://www.twilio.com', 'Twilio.com', ['target' => '_blank'])])"
>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.twilio.settings.account_sid') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'account_sid') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'account_sid') }}" />
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.twilio.settings.account_sid_instruction')) !!}
    </div>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.twilio.settings.auth_token') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'auth_token') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'auth_token') }}" />
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.twilio.settings.from') }}</label>
                <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'from') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'from') }}" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.twilio.settings.from_instruction')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.twilio.settings.to') }}</label>
                <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'to') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'to') }}" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.twilio.settings.to_instruction')) !!}
            </div>
        </div>
    </div>
</x-notification-plus::setting-form>
