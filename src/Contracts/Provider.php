<?php

namespace ArchiElite\NotificationPlus\Contracts;

interface Provider
{
    public function send(string $message): array;
}
