<?php

namespace ArchiElite\NotificationPlus\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use ArchiElite\NotificationPlus\Facades\Notification;
use ArchiElite\NotificationPlus\Services\Telegram as TelegramService;
use Botble\Setting\Supports\SettingStore;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends BaseController
{
    public function index(): View
    {
        PageTitle::setTitle(trans('plugins/notification-plus::notification-plus.name'));

        Assets::addScriptsDirectly('vendor/core/plugins/notification-plus/js/notification-plus.js');

        return view('plugins/notification-plus::settings');
    }

    public function save(Request $request, BaseHttpResponse $response, SettingStore $setting): BaseHttpResponse
    {
        foreach ($request->input() as $key => $value) {
            $setting->set($key, $value);
        }

        $setting->save();

        return $response
            ->setPreviousUrl(route('notification-plus.settings'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function sendTestMessage(Request $request, BaseHttpResponse $response): BaseHttpResponse
    {
        $request->validate([
            'driver' => ['required', 'string', Rule::in(['telegram', 'slack', 'whatsapp', 'sms'])],
            'message' => ['required', 'string'],
        ]);

        $data = Notification::driver($request->input('driver'))->send($request->input('message'));

        if ($data['success'] === false) {
            return $response
                ->setError()
                ->setMessage($data['message']);
        }

        return $response
            ->setPreviousUrl(route('notification-plus.settings'))
            ->setMessage(trans('plugins/notification-plus::notification-plus.send_test_message.success_message'));
    }

    public function getTelegramChatIds(TelegramService $telegramService, BaseHttpResponse $response): BaseHttpResponse
    {
        $chatIds = $telegramService->getChatIds();

        return $response
            ->setData($chatIds);
    }
}
