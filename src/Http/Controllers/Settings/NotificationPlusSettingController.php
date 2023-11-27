<?php

namespace ArchiElite\NotificationPlus\Http\Controllers\Settings;

use Botble\Base\Forms\FormBuilder;
use ArchiElite\NotificationPlus\Forms\Settings\NotificationPlusSettingForm;
use ArchiElite\NotificationPlus\Http\Requests\Settings\NotificationPlusSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class NotificationPlusSettingController extends SettingController
{
    public function edit(FormBuilder $formBuilder)
    {
        $this->pageTitle('Page title');

        return $formBuilder->create(NotificationPlusSettingForm::class)->renderForm();
    }

    public function update(NotificationPlusSettingRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
