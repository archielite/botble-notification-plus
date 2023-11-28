<?php

namespace ArchiElite\NotificationPlus\Providers;

use ArchiElite\NotificationPlus\Contracts\NotificationManager as NotificationManagerContract;
use ArchiElite\NotificationPlus\Drivers\Slack;
use ArchiElite\NotificationPlus\Drivers\Telegram;
use ArchiElite\NotificationPlus\Drivers\Twilio;
use ArchiElite\NotificationPlus\Drivers\Vonage;
use ArchiElite\NotificationPlus\Drivers\WhatsApp;
use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use ArchiElite\NotificationPlus\NotificationManager;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class NotificationPlusServiceProvider extends ServiceProvider implements DeferrableProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->singleton(NotificationManagerContract::class, NotificationManager::class);

        AliasLoader::getInstance()->alias('NotificationPlus', NotificationPlus::class);
    }

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/notification-plus')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadAnonymousComponents()
            ->publishAssets();

        PanelSectionManager::default()->beforeRendering(function () {
            PanelSectionManager::registerItem(
                SettingOthersPanelSection::class,
                fn () => PanelSectionItem::make('notification-plus')
                    ->setTitle(trans('plugins/notification-plus::notification-plus.name'))
                    ->withIcon('ti ti-bell')
                    ->withDescription(trans('plugins/notification-plus::notification-plus.description'))
                    ->withPriority(990)
                    ->withPermission('notification-plus.settings')
                    ->withRoute('notification-plus.settings')
            );
        });

        $this->app->booted(function () {
            $notificationManager = $this->app->make(NotificationManagerContract::class);
            $notificationManager->register(Telegram::class);
            $notificationManager->register(Slack::class);
            $notificationManager->register(WhatsApp::class);
            $notificationManager->register(Vonage::class);
            $notificationManager->register(Twilio::class);
        });
    }

    public function provides(): array
    {
        return [NotificationManagerContract::class];
    }
}
