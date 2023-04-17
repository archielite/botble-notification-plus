<form action="{{ route('notification-plus.send-test-message') }}" method="post">
    @csrf
    <div class="form-group mb-3">
        <input type="hidden" name="driver" value="">
        <label class="control-label">{{ trans('plugins/notification-plus::notification-plus.send_test_message.modal_message_label') }}</label>
        <textarea class="form-control" name="message">{{ __('You have received a test message from Notification Plus plugin on :site.', ['site' => request()->getHost()]) }}</textarea>
    </div>
</form>
