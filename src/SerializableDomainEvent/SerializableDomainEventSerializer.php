<?php

declare(strict_types=1);

namespace Papyrus\Serializer\SerializableDomainEvent;

use Papyrus\Serializer\SerializationFailedException;
use Papyrus\Serializer\Serializer;

/**
 * @implements Serializer<SerializableDomainEvent>
 */
final class SerializableDomainEventSerializer implements Serializer
{
    /**
     * @param object&SerializableDomainEvent $object
     */
    public function serialize(object $object): mixed
    {
        /* @phpstan-ignore-next-line */
        if ($object instanceof SerializableDomainEvent === false) {
            throw new SerializationFailedException('Can only serialize events implementing `SerializableDomainEvent`');
        }

        return $object->serialize();
    }

    /**
     * @param class-string<SerializableDomainEvent> $objectClassName
     */
    public function deserialize(mixed $payload, string $objectClassName): SerializableDomainEvent
    {
        /* @phpstan-ignore-next-line */
        if (is_subclass_of($objectClassName, SerializableDomainEvent::class) === false) {
            throw new SerializationFailedException('Can only deserialize events implementing `SerializableDomainEvent`');
        }

        return $objectClassName::deserialize($payload);
    }
}
