<?php

declare(strict_types=1);

namespace Papyrus\Serializer\SerializableDomainEvent;

interface SerializableDomainEvent
{
    public function serialize(): mixed;

    public static function deserialize(mixed $payload): self;
}
