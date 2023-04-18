@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="max-width-1200">
        {!! apply_filters('ae_notification_plus_before_settings', null) !!}
        {!! apply_filters('ae_notification_plus_settings', NotificationPlus::settings()) !!}
        {!! apply_filters('ae_notification_plus_after_settings', null) !!}
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
                <label class="control-label" for="test-notification-message">{{ trans('plugins/notification-plus::notification-plus.send_test_message.modal_message_label') }}</label>
                <textarea class="form-control" id="test-notification-message" name="message">{{ __('You have received a test message from Notification Plus plugin on :site.', ['site' => request()->getHost()]) }}</textarea>
            </div>
        </form>
    </x-notification-plus::modal>
@endsection
