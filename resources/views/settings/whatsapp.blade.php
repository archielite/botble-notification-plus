<x-notification-plus::setting-form
    driver="whatsapp"
    :title="trans('plugins/notification-plus::notification-plus.whatsapp.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.whatsapp.settings.description', ['link' => Html::link('https://developers.facebook.com/apps', 'Facebook Developer', ['target' => '_blank'])->toHtml()])"
    :validator="\ArchiElite\NotificationPlus\Http\Requests\WhatsAppSettingRequest::class"
>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.phone_number_id') }}</label>
        <input type="text" name="ae_notification_plus[whatsapp_phone_number_id]" class="next-input" value="{{ setting('ae_notification_plus_whatsapp_phone_number_id') }}" placeholder="10xxxxxxxxxxxxxx" />
    </div>

    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.access_token') }}</label>
        <input type="password" name="ae_notification_plus[whatsapp_access_token]" class="next-input" value="{{ setting('ae_notification_plus_whatsapp_access_token') }}" placeholder="EAA..." />
    </div>

    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number') }}</label>
        <input type="text" name="ae_notification_plus[whatsapp_to_phone_number]" class="next-input" value="{{ setting('ae_notification_plus_whatsapp_to_phone_number') }}" placeholder="84xxxxxxxx" />
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number_instruction')) !!}
    </div>
</x-notification-plus::setting-form>
