<?php

declare(strict_types=1);

namespace Papyrus\Serializer;

/**
 * @template T of object
 */
interface Serializer
{
    /**
     * @param T $object
     *
     * @throws SerializationFailedException
     */
    public function serialize(object $object): mixed;

    /**
     * @param class-string<T> $objectClassName
     *
     * @throws SerializationFailedException
     *
     * @return T
     */
    public function deserialize(mixed $payload, string $objectClassName);
}
