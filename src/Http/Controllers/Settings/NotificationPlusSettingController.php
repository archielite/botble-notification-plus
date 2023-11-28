<?php

namespace ArchiElite\NotificationPlus\Http\Controllers\Settings;

use ArchiElite\NotificationPlus\Drivers\Telegram;
use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use ArchiElite\NotificationPlus\Forms\Settings\NotificationPlusSettingForm;
use ArchiElite\NotificationPlus\Http\Requests\Settings\NotificationPlusSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NotificationPlusSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/notification-plus::notification-plus.name'));

        return NotificationPlusSettingForm::create()->renderForm();
    }

    public function update(NotificationPlusSettingRequest $request)
    {
        $data = [];

        foreach ($request->input('ae_notification_plus') as $key => $value) {
            $driver = str($key)->afterLast('archi-elite-notification-plus-drivers-')->toString();

            foreach ($value as $settingKey => $settingValue) {
                $data["ae_notification_plus_archi-elite-notification-plus-drivers-{$driver}_{$settingKey}"] = $settingValue;
            }
        }

        $this->saveSettings($data);

        return $this
            ->httpResponse()
            ->withUpdatedSuccessMessage();
    }

    public function sendTestMessage(Request $request)
    {
        $request->validate([
            'driver' => ['required', 'string', Rule::in(NotificationPlus::getAvailableDrivers())],
            'message' => ['required', 'string', 'max:400'],
        ]);

        try {
            $data = NotificationPlus::driver($request->input('driver'))->send($request->input('message'));

            if ($data['success'] === false) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage($data['message']);
            }

            return $this
                ->httpResponse()
                ->setPreviousUrl(route('notification-plus.settings'))
                ->setMessage(trans('plugins/notification-plus::notification-plus.send_test_message.success_message'));
        } catch (Exception $exception) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    public function getTelegramChatIds(Telegram $telegram)
    {
        $chatIds = $telegram->getChatIds();

        if (empty($chatIds)) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(trans('plugins/notification-plus::notification-plus.telegram.settings.cannot_get_chat_ids'));
        }

        return $this
            ->httpResponse()
            ->setData($chatIds);
    }
}
