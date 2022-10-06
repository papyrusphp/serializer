<?php

declare(strict_types=1);

namespace Papyrus\Serializer\Test\SerializableDomainEvent;

use Papyrus\Serializer\SerializableDomainEvent\SerializableDomainEvent;
use Papyrus\Serializer\SerializableDomainEvent\SerializableDomainEventSerializer;
use Papyrus\Serializer\SerializationFailedException;
use Papyrus\Serializer\Test\SerializableDomainEvent\Stub\TestDomainEvent;
use Papyrus\Serializer\Test\SerializableDomainEvent\Stub\TestSerializableDomainEvent;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SerializableDomainEventSerializerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldSerializeSerializableDomainEvent(): void
    {
        $serializer = new SerializableDomainEventSerializer();

        $payload = $serializer->serialize(new TestSerializableDomainEvent('1ded0f33-1cd4-416d-a7e5-2f06802e91cf'));

        self::assertSame(['aggregateRootId' => '1ded0f33-1cd4-416d-a7e5-2f06802e91cf'], $payload);
    }

    /**
     * @test
     */
    public function itShouldNotSerializeNonSerializableDomainEvent(): void
    {
        $serializer = new SerializableDomainEventSerializer();

        self::expectException(SerializationFailedException::class);

        /* @phpstan-ignore-next-line */
        $serializer->serialize(new TestDomainEvent('c0cb9574-4875-45b2-a9b7-c35aaabea0e0'));
    }

    /**
     * @test
     */
    public function itShouldDeserializeSerializableDomainEvent(): void
    {
        $serializer = new SerializableDomainEventSerializer();

        $event = $serializer->deserialize(
            ['aggregateRootId' => '1ded0f33-1cd4-416d-a7e5-2f06802e91cf'],
            TestSerializableDomainEvent::class,
        );

        self::assertInstanceOf(SerializableDomainEvent::class, $event);
        self::assertSame('1ded0f33-1cd4-416d-a7e5-2f06802e91cf', $event->getAggregateRootId());
    }

    /**
     * @test
     */
    public function itShouldNotDeserializeNonSerializableDomainEvent(): void
    {
        $serializer = new SerializableDomainEventSerializer();

        self::expectException(SerializationFailedException::class);

        $serializer->deserialize(
            ['aggregateRootId' => '1ded0f33-1cd4-416d-a7e5-2f06802e91cf'],
            /* @phpstan-ignore-next-line */
            TestDomainEvent::class,
        );
    }
}
