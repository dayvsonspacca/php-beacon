<?php

declare(strict_types=1);

namespace Beacon;

interface ClientInterface
{
    public function publish(Event $event): EventId;

    public function subscribe(): void;
}
