<?php

declare(strict_types=1);

namespace Papyrus\Serializer\SerializableDomainEvent;

use Papyrus\EventSourcing\DomainEvent;

interface SerializableDomainEvent extends DomainEvent
{
    public function serialize(): mixed;

    public static function deserialize(mixed $payload): self;
}
