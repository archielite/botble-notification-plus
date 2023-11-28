@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
   @include('core/setting::forms.form-content-only')
@stop

@push('footer')
    <x-core::modal
        id="send-test-message-modal"
        :title="trans('plugins/notification-plus::notification-plus.send_test_message.modal_title')"
        :button-label="trans('plugins/notification-plus::notification-plus.send_test_message.modal_button_text')"
        button-id="send-test-message-modal-button"
        :form-action="route('notification-plus.send-test-message')"
        form-method="post"
    >

        <input type="hidden" name="driver" value="">

        <x-core::form.textarea
            :label="trans('plugins/notification-plus::notification-plus.send_test_message.modal_message_label')"
            name="message"
            :helper-text="__('You have received a test message from Notification Plus plugin on :site.', ['site' => request()->getHost()])"
        />
    </x-core::modal>
@endpush
