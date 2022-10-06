<?php

declare(strict_types=1);

namespace Papyrus\Serializer;

use Exception;
use Throwable;

final class SerializationFailedException extends Exception
{
    public static function create(Throwable $exception): self
    {
        return new self(
            sprintf('Failed (de)serialization: `%s`', $exception->getMessage()),
            $exception->getCode(),
            $exception,
        );
    }
}
