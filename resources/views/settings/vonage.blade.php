<x-notification-plus::setting-form
    :$name
    :$driver
    :$validator
    :title="trans('plugins/notification-plus::notification-plus.vonage.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.vonage.settings.description', ['link' => Html::link('https://dashboard.nexmo.com/', 'Nexmo.com', ['target' => '_blank'])])"
>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.vonage.settings.api_key') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'api_key') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'api_key') }}" />
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.vonage.settings.api_key_instruction')) !!}
    </div>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.vonage.settings.api_secret') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'api_secret') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'api_secret') }}" />
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.vonage.settings.from') }}</label>
                <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'from') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'from') }}" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.vonage.settings.from_instruction')) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.vonage.settings.to') }}</label>
                <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'to') }}" class="next-input" value="{{ NotificationPlus::getSetting($name, 'to') }}" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.vonage.settings.to_instruction')) !!}
            </div>
        </div>
    </div>
</x-notification-plus::setting-form>
