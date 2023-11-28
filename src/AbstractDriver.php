<?php

namespace ArchiElite\NotificationPlus;

use ArchiElite\NotificationPlus\Facades\NotificationPlus;
use Illuminate\Support\Arr;

abstract class AbstractDriver
{
    protected string $validatorClass;

    protected string $viewPath;

    abstract public function send(string $message, array $data = []): array;

    public function settings(): string
    {
        return view($this->viewPath, [
            'name' => $this->getName(),
            'driver' => get_class($this),
            'validator' => $this->validatorClass,
        ])->render();
    }

    public function isEnabled(): bool
    {
        return (bool) $this->getSetting('enable');
    }

    protected function getSetting(string $key): ?string
    {
        return NotificationPlus::getSetting($this->getName(), $key);
    }

    public function getName(): string
    {
        return str($this::class)->afterLast('\\')->lower()->toString();
    }

    public function getShortName(): string
    {
        return strtolower(Arr::last(explode('\\', get_class($this))));
    }
}
