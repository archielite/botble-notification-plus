@props([
    'title',
    'description' => null,
    'driver',
    'validator' => null,
])

<div class="flexbox-annotated-section">
    <div class="flexbox-annotated-section-annotation">
        <div class="annotated-section-title pd-all-20">
            <h2>{!! $title !!}</h2>
        </div>
        @if($description)
            <div class="annotated-section-description pd-all-20 p-none-t">
                <p class="color-note">{!! $description !!}</p>
            </div>
        @endif
    </div>

    <div class="flexbox-annotated-section-content">
        <form action="{{ route('notification-plus.settings') }}" method="post" class="wrapper-content pd-all-20 notification-settings-form" id="{{ $driver }}-settings-form">
            @csrf

            <div>
                <input type="hidden" name="ae_notification_plus[{{ $driver }}_enable]" value="0">
                <label>
                    <input type="checkbox" class="enable-notification-item-checkbox" value="1" name="ae_notification_plus[{{ $driver }}_enable]" id="notification_{{ $driver }}_enable" @checked(setting('ae_notification_plus_' . $driver . '_enable'))>
                    {{ trans("plugins/notification-plus::notification-plus.$driver.settings.enable") }}
                </label>
            </div>

            <div class="mt-3 notification-wrapper" @if (! setting('ae_notification_plus_' . $driver . '_enable')) style="display: none;" @endif>
                {{ $slot }}

                <button type="submit" class="btn btn-info">
                    {{ trans('core/setting::setting.save_settings') }}
                </button>
                <button type="button" class="btn btn-warning send-test-message" data-driver="{{ $driver }}">
                    {{ trans('plugins/notification-plus::notification-plus.send_test_message.button_text') }}
                </button>
            </div>
        </form>
    </div>
</div>

@pushif($validator, 'footer')
    {!! JsValidator::formRequest($validator, "#$driver-settings-form") !!}
@endpushif
