@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="max-width-1200">
        @include('plugins/notification-plus::settings.telegram')
        @include('plugins/notification-plus::settings.slack')
        @include('plugins/notification-plus::settings.whatsapp')
        @include('plugins/notification-plus::settings.sms')
        {!! apply_filters('ae_notification_plus_plus_settings', null) !!}
    </div>

    <x-notification-plus::modal
        id="send-test-message-modal"
        :title="trans('plugins/notification-plus::notification-plus.send_test_message.modal_title')"
        :button-label="trans('plugins/notification-plus::notification-plus.send_test_message.modal_button_text')"
    >
        <form action="{{ route('notification-plus.send-test-message') }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <input type="hidden" name="driver" value="">
                <label class="control-label">{{ trans('plugins/notification-plus::notification-plus.send_test_message.modal_message_label') }}</label>
                <textarea class="form-control" name="message">{{ __('You have received a test message from Notification Plus plugin on :site.', ['site' => request()->getHost()]) }}</textarea>
            </div>
        </form>
    </x-notification-plus::modal>
@endsection
