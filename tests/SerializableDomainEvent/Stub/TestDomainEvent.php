<?php

declare(strict_types=1);

namespace Papyrus\Serializer\Test\SerializableDomainEvent\Stub;

use Papyrus\EventSourcing\DomainEvent;

final class TestDomainEvent implements DomainEvent
{
    public function __construct(
        public readonly string $aggregateRootId,
    ) {
    }

    public function getAggregateRootId(): string
    {
        return $this->aggregateRootId;
    }
}
