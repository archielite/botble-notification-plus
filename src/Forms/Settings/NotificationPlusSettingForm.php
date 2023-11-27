<?php

namespace ArchiElite\NotificationPlus\Forms\Settings;

use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use ArchiElite\NotificationPlus\Http\Requests\Settings\NotificationPlusSettingRequest;
use Botble\Setting\Forms\SettingForm;

class NotificationPlusSettingForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        $this
            ->setSectionTitle(trans('plugins/notification-plus::notification-plus.name'))
            ->setSectionDescription(trans('plugins/notification-plus::notification-plus.description'))
            ->setValidatorClass(NotificationPlusSettingRequest::class)
            ->add('drivers', 'html', [
                'html' => NotificationPlus::settings(),
            ]);
    }
}
