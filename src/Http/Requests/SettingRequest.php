<?php

namespace ArchiElite\NotificationPlus\Http\Requests;

use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use Botble\Support\Http\Requests\Request;
use Illuminate\Support\Str;

class SettingRequest extends Request
{
    protected function inputKey(string $driver, string $key): string
    {
        return NotificationPlus::getSettingKey(Str::slug(Str::snake($driver)), $key);
    }
}
