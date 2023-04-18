<x-notification-plus::setting-form
    :$name
    :$driver
    :$validator
    :title="trans('plugins/notification-plus::notification-plus.telegram.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.telegram.settings.description', ['link' => Html::link('https://core.telegram.org/bots/features#creating-a-new-bot', 'Creating a new bot', ['target' => '_blank'])->toHtml()])"
>
    <div class="mb-3 form-group">
        <label class="text-title-field">{{ trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token') }}</label>
        <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'bot_token') }}" class="next-input js-telegram-bot-token" value="{{ NotificationPlus::getSetting($name, 'bot_token') }}" placeholder="E.g: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11">
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])) !!}
    </div>

    <div class="mb-3 telegram-chat-id-wrapper" @if(! NotificationPlus::getSetting($name, 'bot_token')) style="display: none" @endif>
        <div class="input-group">
            <input type="text" name="{{ NotificationPlus::getSettingKey($name, 'chat_id') }}" class="form-control next-input" value="{{ NotificationPlus::getSetting($name, 'chat_id') }}" placeholder="E.g: -1001824073962">
            <button type="button" class="btn btn-warning" id="get-telegram-chat-ids">
                {{ trans('plugins/notification-plus::notification-plus.telegram.settings.get_chat_ids') }}
            </button>
        </div>
        {!! Form::helper(trans('plugins/notification-plus::notification-plus.telegram.settings.chat_id_instruction')) !!}

        <ul id="telegram-list-chat-ids"></ul>
    </div>
</x-notification-plus::setting-form>
