<?php

namespace ArchiElite\NotificationPlus\Providers;

use ArchiElite\NotificationPlus\Drivers\Slack;
use ArchiElite\NotificationPlus\Drivers\Vonage;
use ArchiElite\NotificationPlus\Drivers\Telegram;
use ArchiElite\NotificationPlus\Drivers\Twilio;
use ArchiElite\NotificationPlus\Drivers\WhatsApp;
use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use ArchiElite\NotificationPlus\Contracts\NotificationManager as NotificationManagerContract;
use ArchiElite\NotificationPlus\NotificationManager;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Events\RouteMatched;
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
            ->publishAssets();

        $this->app['events']->listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id' => 'cms-plugins-notification-plus',
                'parent_id' => 'cms-core-settings',
                'priority' => 5,
                'name' => 'plugins/notification-plus::notification-plus.name',
                'icon' => null,
                'url' => route('notification-plus.settings'),
                'permissions' => ['notification-plus.settings'],
            ]);
        });

        $this->app->booted(function () {
            $notificationManager = $this->app->make(NotificationManagerContract::class);
            $notificationManager->register(Telegram::class);
            $notificationManager->register(Slack::class);
            $notificationManager->register(WhatsApp::class);
            $notificationManager->register(Vonage::class);
            $notificationManager->register(Twilio::class);
        });

        $this->app['blade.compiler']->anonymousComponentPath($this->getViewsPath() . '/components', 'notification-plus');
    }

    public function provides(): array
    {
        return [NotificationManagerContract::class];
    }
}
