<?php

namespace ArchiElite\NotificationPlus\Http\Controllers;

use ArchiElite\NotificationPlus\Drivers\Telegram;
use Botble\Base\Facades\Assets;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use Botble\Setting\Supports\SettingStore;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class SettingController extends BaseController
{
    public function index(): View
    {
        PageTitle::setTitle(trans('plugins/notification-plus::notification-plus.name'));

        Assets::addScriptsDirectly([
            'vendor/core/core/js-validation/js/js-validation.js',
            'vendor/core/plugins/notification-plus/js/notification-plus.js',
        ]);

        return view('plugins/notification-plus::settings');
    }

    public function save(Request $request, BaseHttpResponse $response, SettingStore $setting): BaseHttpResponse
    {
        foreach ($request->input('ae_notification_plus.' . $request->input('driver'), []) as $key => $value) {
            $setting->set('ae_notification_plus_' . $request->input('driver') . '_' . $key, $value);
        }

        $setting->save();

        return $response
            ->setPreviousUrl(route('notification-plus.settings'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function sendTestMessage(Request $request, BaseHttpResponse $response): BaseHttpResponse
    {
        $request->validate([
            'driver' => ['required', 'string', Rule::in(NotificationPlus::getAvailableDrivers())],
            'message' => ['required', 'string'],
        ]);

        try {
            $data = NotificationPlus::driver($request->input('driver'))->send($request->input('message'));

            if ($data['success'] === false) {
                return $response
                    ->setError()
                    ->setMessage($data['message']);
            }

            return $response
                ->setPreviousUrl(route('notification-plus.settings'))
                ->setMessage(trans('plugins/notification-plus::notification-plus.send_test_message.success_message'));
        } catch (Throwable $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    public function getTelegramChatIds(Telegram $telegram, BaseHttpResponse $response): BaseHttpResponse
    {
        $chatIds = $telegram->getChatIds();

        if (empty($chatIds)) {
            return $response
                ->setError()
                ->setMessage(trans('plugins/notification-plus::notification-plus.telegram.settings.cannot_get_chat_ids'));
        }

        return $response
            ->setData($chatIds);
    }
}
