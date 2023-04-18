<?php

namespace ArchiElite\NotificationPlus\Providers;

use Botble\Base\Traits\LoadAndPublishDataTrait;
use ArchiElite\NotificationPlus\Contracts\Factory;
use ArchiElite\NotificationPlus\NotificationManager;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class NotificationPlusServiceProvider extends ServiceProvider implements DeferrableProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->singleton(Factory::class, fn ($app) => new NotificationManager($app));
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

        Event::listen(RouteMatched::class, function () {
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

        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components', 'notification-plus');
    }

    public function provides(): array
    {
        return [Factory::class];
    }
}
