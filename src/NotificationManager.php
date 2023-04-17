<?php

namespace ArchiElite\NotificationPlus;

use ArchiElite\NotificationPlus\Contracts\Factory;
use ArchiElite\NotificationPlus\Drivers\Sms;
use ArchiElite\NotificationPlus\Drivers\Slack;
use ArchiElite\NotificationPlus\Drivers\Telegram;
use ArchiElite\NotificationPlus\Drivers\WhatsApp;
use ArchiElite\NotificationPlus\Services\Telegram as TelegramService;
use Illuminate\Support\Manager;
use InvalidArgumentException;

class NotificationManager extends Manager implements Factory
{
    protected function createTelegramDriver(): Telegram
    {
        return new Telegram(new TelegramService());
    }

    protected function createSlackDriver(): Slack
    {
        return new Slack(setting('notification_slack_webhook_url'));
    }

    protected function createWhatsappDriver(): WhatsApp
    {
        return new WhatsApp(
            setting('notification_whatsapp_phone_number_id'),
            setting('notification_whatsapp_to_phone_number'),
            setting('notification_whatsapp_access_token')
        );
    }

    protected function createSmsDriver(): Sms
    {
        return new Sms(
            setting('notification_sms_vonage_api_key'),
            setting('notification_sms_vonage_api_secret'),
            setting('notification_sms_vonage_from'),
            setting('notification_sms_vonage_to')
        );
    }

    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No notification driver was specified.');
    }
}
