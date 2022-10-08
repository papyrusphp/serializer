<?php

declare(strict_types=1);

namespace Papyrus\Serializer\SerializableDomainEvent;

use Papyrus\EventSourcing\DomainEvent;
use Papyrus\Serializer\Serializer;

/**
 * @implements Serializer<DomainEvent|SerializableDomainEvent>
 */
final class SerializableDomainEventSerializerDecorator implements Serializer
{
    /**
     * @param Serializer<DomainEvent> $serializer
     */
    public function __construct(
        private readonly SerializableDomainEventSerializer $serializableDomainEventSerializer,
        private readonly Serializer $serializer,
    ) {
    }

    /**
     * @param object&(DomainEvent|SerializableDomainEvent) $object
     */
    public function serialize(object $object): mixed
    {
        if ($object instanceof SerializableDomainEvent === false) {
            return $this->serializer->serialize($object);
        }

        return $this->serializableDomainEventSerializer->serialize($object);
    }

    /**
     * @param class-string<DomainEvent|SerializableDomainEvent> $objectClassName
     */
    public function deserialize(mixed $payload, string $objectClassName): SerializableDomainEvent|DomainEvent
    {
        if (is_subclass_of($objectClassName, SerializableDomainEvent::class) === false) {
            return $this->serializer->deserialize($payload, $objectClassName);
        }

        return $this->serializableDomainEventSerializer->deserialize($payload, $objectClassName);
    }
}
