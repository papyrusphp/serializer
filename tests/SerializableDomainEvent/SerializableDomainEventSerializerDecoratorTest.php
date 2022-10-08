<?php

declare(strict_types=1);

namespace Papyrus\Serializer\Test\SerializableDomainEvent;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Papyrus\EventSourcing\DomainEvent;
use Papyrus\Serializer\SerializableDomainEvent\SerializableDomainEventSerializer;
use Papyrus\Serializer\SerializableDomainEvent\SerializableDomainEventSerializerDecorator;
use Papyrus\Serializer\Serializer;
use Papyrus\Serializer\Test\SerializableDomainEvent\Stub\TestDomainEvent;
use Papyrus\Serializer\Test\SerializableDomainEvent\Stub\TestSerializableDomainEvent;

/**
 * @internal
 */
class SerializableDomainEventSerializerDecoratorTest extends MockeryTestCase
{
    /**
     * @var MockInterface&Serializer<DomainEvent>
     */
    private MockInterface $serializer;

    private SerializableDomainEventSerializerDecorator $decorator;

    protected function setUp(): void
    {
        $this->decorator = new SerializableDomainEventSerializerDecorator(
            new SerializableDomainEventSerializer(),
            $this->serializer = Mockery::mock(Serializer::class),
        );

        parent::setUp();
    }

    /**
     * @test
     */
    public function itShouldSerializeSerializableDomainEventWithSerializableDomainEventSerializer(): void
    {
        $this->serializer->expects('serialize')->never();

        $payload = $this->decorator->serialize(new TestSerializableDomainEvent('3c3b0d47-f9cb-457c-8d52-7a3dc99fac9e'));

        self::assertSame(['aggregateRootId' => '3c3b0d47-f9cb-457c-8d52-7a3dc99fac9e'], $payload);
    }

    /**
     * @test
     */
    public function itShouldSerializeDomainEventWithDecoratedSerializer(): void
    {
        $this->serializer->expects('serialize')->andReturn(['payload']);

        $payload = $this->decorator->serialize(new TestDomainEvent('3c3b0d47-f9cb-457c-8d52-7a3dc99fac9e'));

        self::assertSame(['payload'], $payload);
    }

    /**
     * @test
     */
    public function itShouldDeserializeSerializableDomainEventWithSerializableDomainEventSerializer(): void
    {
        $this->serializer->expects('deserialize')->never();

        $event = $this->decorator->deserialize(
            ['aggregateRootId' => '3c3b0d47-f9cb-457c-8d52-7a3dc99fac9e'],
            TestSerializableDomainEvent::class,
        );

        self::assertInstanceOf(TestSerializableDomainEvent::class, $event);
        self::assertSame('3c3b0d47-f9cb-457c-8d52-7a3dc99fac9e', $event->aggregateRootId);
    }

    /**
     * @test
     */
    public function itShouldDeserializeDomainEventWithDecoratedSerializer(): void
    {
        $this->serializer->expects('deserialize')->andReturn(
            $deserializedEvent = new TestDomainEvent('3c3b0d47-f9cb-457c-8d52-7a3dc99fac9e'),
        );

        $event = $this->decorator->deserialize(
            ['aggregateRootId' => '3c3b0d47-f9cb-457c-8d52-7a3dc99fac9e'],
            TestDomainEvent::class,
        );

        self::assertSame($deserializedEvent, $event);
    }
}
