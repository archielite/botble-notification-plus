<div class="mb-5">
    <h4 class="card-title mb-2">{{ $title }}</h4>
    <p class="text-muted">{!! BaseHelper::clean($description) !!}

    <input type="hidden" name="driver" value="{{ $name }}">

    <x-core::form.on-off.checkbox
        :label="trans('plugins/notification-plus::notification-plus.settings.enable')"
        :name="NotificationPlus::getSettingKey($name, 'enable')"
        :checked="NotificationPlus::getSetting($name, 'enable')"
        data-bb-toggle="collapse"
        data-bb-target="#notification-{{ $name }}-settings"
    />

    <x-core::form.fieldset id="notification-{{ $name }}-settings" style="display: {{ NotificationPlus::getSetting($name, 'enable') ? 'block' : 'none' }}">
        {{ $slot }}

        <x-core::button size="sm" class="send-test-message" data-driver="{{ $driver }}">
            {{ trans('plugins/notification-plus::notification-plus.send_test_message.button_text') }}
        </x-core::button>
    </x-core::form.fieldset>
</div>
