@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <form action="{{ route('notification-plus.settings') }}" method="post" class="notification-settings-form">
        @csrf
        <div class="max-width-1200">
            <div class="flexbox-annotated-section">
                <div class="flexbox-annotated-section-annotation">
                    <div class="annotated-section-title pd-all-20">
                        <h2>{{ trans('plugins/notification-plus::notification-plus.telegram.settings.title') }}</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note">{!! trans('plugins/notification-plus::notification-plus.telegram.settings.description', ['link' => Html::link('https://core.telegram.org/bots/features#creating-a-new-bot', 'Creating a new bot', ['target' => '_blank'])->toHtml()]) !!}</p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20">
                        <div class="mb-3 form-group">
                            <input type="hidden" name="notification_telegram_enable" value="0">
                            <label>
                                <input type="checkbox" class="hrv-checkbox" value="1" name="notification_telegram_enable" id="notification_telegram_enable" @checked(setting('notification_telegram_enable'))>
                                {{ trans('plugins/notification-plus::notification-plus.telegram.settings.enable') }}
                            </label>
                        </div>

                        <div class="notification-wrapper" @if (! setting('notification_telegram_enable')) style="display: none;" @endif>
                            <div class="mb-3 form-group">
                                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token') }}</label>
                                <input type="text" name="notification_telegram_bot_token" class="next-input" value="{{ setting('notification_telegram_bot_token') }}" placeholder="E.g: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11">
                                {!! Form::helper(trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])) !!}
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="notification_telegram_chat_id" class="form-control next-input" value="{{ setting('notification_telegram_chat_id') }}" placeholder="E.g: -1001824073962">
                                    <button type="button" class="btn btn-warning" id="get-telegram-chat-ids">
                                        {{ trans('plugins/notification-plus::notification-plus.telegram.settings.get_chat_ids') }}
                                    </button>
                                </div>
                                {!! Form::helper(trans('plugins/notification-plus::notification-plus.telegram.settings.chat_id_instruction')) !!}

                                <ul id="telegram-list-chat-ids"></ul>
                            </div>


                            @include('plugins/notification-plus::partials.send-test-message-button', ['driver' => 'telegram'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="flexbox-annotated-section">
                <div class="flexbox-annotated-section-annotation">
                    <div class="annotated-section-title pd-all-20">
                        <h2>{{ trans('plugins/notification-plus::notification-plus.slack.settings.title') }}</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note">{!! trans('plugins/notification-plus::notification-plus.slack.settings.description', ['link' => Html::link('https://api.slack.com/messaging/webhooks', 'tutorial', ['target' => '_blank'])]) !!}</p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20">
                        <div class="mb-3 form-group">
                            <input type="hidden" name="notification_slack_enable" value="0">
                            <label>
                                <input type="checkbox" class="hrv-checkbox" value="1" name="notification_slack_enable" @checked(setting('notification_slack_enable'))>
                                {{ trans('plugins/notification-plus::notification-plus.slack.settings.enable') }}
                            </label>
                        </div>

                        <div class="notification-wrapper" @if (! setting('notification_slack_enable')) style="display: none;" @endif>
                            <div class="mb-3 form-group">
                                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url') }}</label>
                                <input type="text" name="notification_slack_webhook_url" class="next-input" value="{{ setting('notification_slack_webhook_url') }}" placeholder="E.g: https://hooks.slack.com/services/XXXXXXXXX/XXXXXXXXX/XXXXXXXXXXXXXXXXXXXXXXXX">
                                {!! Form::helper(trans('plugins/notification-plus::notification-plus.slack.settings.webhook_url_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])) !!}
                            </div>

                            @include('plugins/notification-plus::partials.send-test-message-button', ['driver' => 'slack'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="flexbox-annotated-section">
                <div class="flexbox-annotated-section-annotation">
                    <div class="annotated-section-title pd-all-20">
                        <h2>{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.title') }}</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note">{!! trans('plugins/notification-plus::notification-plus.whatsapp.settings.description', ['link' => Html::link('https://developers.facebook.com/apps', 'Facebook Developer', ['target' => '_blank'])->toHtml()]) !!}</p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20">
                        <div class="mb-3 form-group">
                            <input type="hidden" name="notification_whatsapp_enable" value="0">
                            <label>
                                <input type="checkbox" class="hrv-checkbox" value="1" name="notification_whatsapp_enable" @checked(setting('notification_whatsapp_enable'))>
                                {{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.enable') }}
                            </label>
                        </div>

                        <div class="notification-wrapper" @if (! setting('notification_whatsapp_enable')) style="display: none;" @endif>
                            <div class="mb-3 form-group">
                                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.phone_number_id') }}</label>
                                <input type="text" name="notification_whatsapp_phone_number_id" class="next-input" value="{{ setting('notification_whatsapp_phone_number_id') }}" placeholder="10xxxxxxxxxxxxxx" />
                            </div>

                            <div class="mb-3 form-group">
                                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.access_token') }}</label>
                                <input type="password" name="notification_whatsapp_access_token" class="next-input" value="{{ setting('notification_whatsapp_access_token') }}" placeholder="EAA..." />
                            </div>

                            <div class="mb-3 form-group">
                                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number') }}</label>
                                <input type="text" name="notification_whatsapp_to_phone_number" class="next-input" value="{{ setting('notification_whatsapp_to_phone_number') }}" placeholder="84xxxxxxxx" />
                                {!! Form::helper(trans('plugins/notification-plus::notification-plus.whatsapp.settings.to_phone_number_instruction')) !!}
                            </div>

                            @include('plugins/notification-plus::partials.send-test-message-button', ['driver' => 'whatsapp'])
                        </div>
                    </div>
                </div>
            </div>

            <div class="flexbox-annotated-section">
                <div class="flexbox-annotated-section-annotation">
                    <div class="annotated-section-title pd-all-20">
                        <h2>{{ trans('plugins/notification-plus::notification-plus.sms.settings.title') }}</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note">{!! trans('plugins/notification-plus::notification-plus.sms.settings.description', ['link' => Html::link('https://dashboard.nexmo.com/', 'Nexmo.com', ['target' => '_blank'])]) !!}</p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20">
                        <div class="mb-3 form-group">
                            <input type="hidden" name="notification_sms_enable" value="0">
                            <label>
                                <input type="checkbox" class="hrv-checkbox" value="1" name="notification_sms_enable" @checked(setting('notification_sms_enable'))>
                                {{ trans('plugins/notification-plus::notification-plus.sms.settings.enable') }}
                            </label>
                        </div>

                        <div class="notification-wrapper" @if (! setting('notification_sms_enable')) style="display: none;" @endif>
                            <div class="mb-3 form-group">
                                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_key') }}</label>
                                <input type="text" name="notification_sms_vonage_api_key" class="next-input" value="{{ setting('notification_sms_vonage_api_key') }}" />
                                {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_key_instruction')) !!}
                            </div>
                            <div class="mb-3 form-group">
                                <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.api_secret') }}</label>
                                <input type="text" name="notification_sms_vonage_api_secret" class="next-input" value="{{ setting('notification_sms_vonage_api_secret') }}" />
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.from') }}</label>
                                        <input type="text" name="notification_sms_vonage_from" class="next-input" value="{{ setting('notification_sms_vonage_from') }}" />
                                        {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.from_instruction')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 form-group">
                                        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.sms.settings.vonage.to') }}</label>
                                        <input type="text" name="notification_sms_vonage_to" class="next-input" value="{{ setting('notification_sms_vonage_to') }}" />
                                        {!! Form::helper(trans('plugins/notification-plus::notification-plus.sms.settings.vonage.to_instruction')) !!}
                                    </div>
                                </div>
                            </div>

                            @include('plugins/notification-plus::partials.send-test-message-button', ['driver' => 'sms'])
                        </div>
                    </div>
                </div>
            </div>

            {!! apply_filters('notification_plus_settings', null) !!}

            <div class="flexbox-annotated-section">
                <div class="flexbox-annotated-section-annotation"></div>
                <div class="flexbox-annotated-section-content">
                    <button class="btn btn-info" type="submit">{{ trans('core/setting::setting.save_settings') }}</button>
                </div>
            </div>
        </div>
    </form>
    {!! Form::modalAction('send-test-message-modal', trans('plugins/notification-plus::notification-plus.send_test_message.modal_title'), 'info', view('plugins/notification-plus::partials.test-notification')->render(), 'send-test-message', trans('plugins/notification-plus::notification-plus.send_test_message.modal_button_text')) !!}
@endsection
