@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="max-width-1200">
        <x-notification-plus::setting-form
            driver="telegram"
            :title="trans('plugins/notification-plus::notification-plus.telegram.settings.title')"
            :description="trans('plugins/notification-plus::notification-plus.telegram.settings.description', ['link' => Html::link('https://core.telegram.org/bots/features#creating-a-new-bot', 'Creating a new bot', ['target' => '_blank'])->toHtml()])"
            :validator="\ArchiElite\NotificationPlus\Http\Requests\TelegramSettingRequest::class"
        >
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token') }}</label>
                <input type="text" name="ae_notification_plus_telegram_bot_token" class="next-input" value="{{ setting('ae_notification_plus_telegram_bot_token') }}" placeholder="E.g: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11">
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])) !!}
            </div>

            <div class="mb-3 telegram-chat-id-wrapper" @if(! setting('ae_notification_plus_telegram_bot_token')) style="display: none" @endif>
                <div class="input-group">
                    <input type="text" name="ae_notification_plus_telegram_chat_id" class="form-control next-input" value="{{ setting('ae_notification_plus_telegram_chat_id') }}" placeholder="E.g: -1001824073962">
                    <button type="button" class="btn btn-warning" id="get-telegram-chat-ids">
                        {{ trans('plugins/notification-plus::notification-plus.telegram.settings.get_chat_ids') }}
                    </button>
                </div>
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.telegram.settings.chat_id_instruction')) !!}

                <ul id="telegram-list-chat-ids"></ul>
            </div>
        </x-notification-plus::setting-form>

        <x-notification-plus::setting-form
            driver="slack"
            :title="trans('plugins/notification-plus::notification-plus.slack.settings.title')"
            :description="trans('plugins/notification-plus::notification-plus.slack.settings.description', ['link' => Html::link('https://api.slack.com/messaging/webhooks', 'tutorial', ['target' => '_blank'])])"
            :validator="\ArchiElite\NotificationPlus\Http\Requests\SlackSettingRequest::class"
        >
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url') }}</label>
                <input type="text" name="ae_notification_plus_slack_webhook_url" class="next-input" value="{{ setting('ae_notification_plus_slack_webhook_url') }}" placeholder="E.g: https://hooks.slack.com/services/XXXXXXXXX/XXXXXXXXX/XXXXXXXXXXXXXXXXXXXXXXXX">
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])) !!}
            </div>
        </x-notification-plus::setting-form>

        <x-notification-plus::setting-form
            driver="whatsapp"
            :title="trans('plugins/notification-plus::notification-plus.whatsapp.settings.title')"
            :description="trans('plugins/notification-plus::notification-plus.whatsapp.settings.description', ['link' => Html::link('https://developers.facebook.com/apps', 'Facebook Developer', ['target' => '_blank'])->toHtml()])"
            :validator="\ArchiElite\NotificationPlus\Http\Requests\WhatsAppSettingRequest::class"
        >
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.phone_number_id') }}</label>
                <input type="text" name="ae_notification_plus_whatsapp_phone_number_id" class="next-input" value="{{ setting('ae_notification_plus_whatsapp_phone_number_id') }}" placeholder="10xxxxxxxxxxxxxx" />
            </div>

            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.access_token') }}</label>
                <input type="password" name="ae_notification_plus_whatsapp_access_token" class="next-input" value="{{ setting('ae_notification_plus_whatsapp_access_token') }}" placeholder="EAA..." />
            </div>

            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number') }}</label>
                <input type="text" name="ae_notification_plus_whatsapp_to_phone_number" class="next-input" value="{{ setting('ae_notification_plus_whatsapp_to_phone_number') }}" placeholder="84xxxxxxxx" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number_instruction')) !!}
            </div>
        </x-notification-plus::setting-form>

        <x-notification-plus::setting-form
            driver="sms"
            :title="trans('plugins/notification-plus::notification-plus.sms.settings.title')"
            :description="trans('plugins/notification-plus::notification-plus.sms.settings.description', ['link' => Html::link('https://dashboard.nexmo.com/', 'Nexmo.com', ['target' => '_blank'])])"
            :validator="\ArchiElite\NotificationPlus\Http\Requests\SmsSettingRequest::class"
        >
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_key') }}</label>
                <input type="text" name="ae_notification_plus_sms_vonage_api_key" class="next-input" value="{{ setting('ae_notification_plus_sms_vonage_api_key') }}" />
                {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_key_instruction')) !!}
            </div>
            <div class="mb-3 form-group">
                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_secret') }}</label>
                <input type="text" name="ae_notification_plus_sms_vonage_api_secret" class="next-input" value="{{ setting('ae_notification_plus_sms_vonage_api_secret') }}" />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 form-group">
                        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.from') }}</label>
                        <input type="text" name="ae_notification_plus_sms_vonage_from" class="next-input" value="{{ setting('ae_notification_plus_sms_vonage_from') }}" />
                        {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.from_instruction')) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 form-group">
                        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.to') }}</label>
                        <input type="text" name="ae_notification_plus_sms_vonage_to" class="next-input" value="{{ setting('ae_notification_plus_sms_vonage_to') }}" />
                        {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.to_instruction')) !!}
                    </div>
                </div>
            </div>
        </x-notification-plus::setting-form>

        {!! apply_filters('ae_notification_plus_plus_settings', null) !!}
    </div>
    {!! Form::modalAction('send-test-message-modal', trans('plugins/notification-plus::notification-plus.send_test_message.modal_title'), 'info', view('plugins/notification-plus::partials.test-notification')->render(), 'send-test-message', trans('plugins/notification-plus::notification-plus.send_test_message.modal_button_text')) !!}
@endsection
