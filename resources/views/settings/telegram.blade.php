<x-plugins-notification-plus::setting-form
    :$name
    :$driver
    :title="trans('plugins/notification-plus::notification-plus.telegram.settings.title')"
    :description="trans('plugins/notification-plus::notification-plus.telegram.settings.description', ['link' => Html::link('https://core.telegram.org/bots/features#creating-a-new-bot', 'Creating a new bot', ['target' => '_blank'])->toHtml()])"
>
    <x-core::form.text-input
        :label="trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token')"
        :name="NotificationPlus::getSettingKey($name, 'bot_token')"
        :value="NotificationPlus::getSetting($name, 'bot_token')"
        placeholder="E.g: 123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11"
        class="js-telegram-bot-token"
        :helper-text="trans('plugins/notification-plus::notification-plus.telegram.settings.bot_token_instruction', ['link' => Html::link('https://t.me/BotFather', '@BotFather', ['target' => '_blank'])->toHtml()])"
    />

    <div class="telegram-chat-id-wrapper" @if(! NotificationPlus::getSetting($name, 'bot_token')) style="display: none" @endif>
        <x-core::form.text-input
            :name="NotificationPlus::getSettingKey($name, 'chat_id')"
            :value="NotificationPlus::getSetting($name, 'chat_id')"
            placeholder="E.g: -1001824073962"
            :helper-text="trans('plugins/notification-plus::notification-plus.telegram.settings.chat_id_instruction')"
        >
            <x-slot:append>
                <x-core::button id="get-telegram-chat-ids" :data-url="route('notification-plus.get-telegram-chat-ids')">
                    {{ trans('plugins/notification-plus::notification-plus.telegram.settings.get_chat_ids') }}
                </x-core::button>
            </x-slot:append>
        </x-core::form.text-input>

        <ul id="telegram-list-chat-ids"></ul>
    </div>
</x-plugins-notification-plus::setting-form>
