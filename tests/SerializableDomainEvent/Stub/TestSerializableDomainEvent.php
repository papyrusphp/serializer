<?php

declare(strict_types=1);

namespace Papyrus\Serializer\Test\SerializableDomainEvent\Stub;

use Papyrus\Serializer\SerializableDomainEvent\SerializableDomainEvent;

final class TestSerializableDomainEvent implements SerializableDomainEvent
{
    public function __construct(
        public readonly string $aggregateRootId,
    ) {
    }

    public static function getEventName(): string
    {
        return 'test.serializable_event_name';
    }

    public function getAggregateRootId(): string
    {
        return $this->aggregateRootId;
    }

    /**
     * @return array{aggregateRootId: string}
     */
    public function serialize(): mixed
    {
        return [
            'aggregateRootId' => $this->aggregateRootId,
        ];
    }

    /**
     * @param array{aggregateRootId: string} $payload
     */
    public static function deserialize(mixed $payload): SerializableDomainEvent
    {
        return new self($payload['aggregateRootId']);
    }
}
