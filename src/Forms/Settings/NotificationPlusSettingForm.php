<?php

namespace ArchiElite\NotificationPlus\Forms\Settings;

use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use ArchiElite\NotificationPlus\Http\Requests\Settings\NotificationPlusSettingRequest;
use Botble\Base\Facades\Assets;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Setting\Forms\SettingForm;

class NotificationPlusSettingForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        Assets::addScriptsDirectly('vendor/core/plugins/notification-plus/js/notification-plus.js');

        $this
            ->setSectionTitle(trans('plugins/notification-plus::notification-plus.name'))
            ->setSectionDescription(trans('plugins/notification-plus::notification-plus.description'))
            ->setFormOption('template', 'plugins/notification-plus::settings')
            ->setValidatorClass(NotificationPlusSettingRequest::class)
            ->setFormOption('class', 'notification-settings-form')
            ->add('drivers', HtmlField::class, [
                'html' => NotificationPlus::settings(),
            ]);
    }
}
