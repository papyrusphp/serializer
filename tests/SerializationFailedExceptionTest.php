<?php

declare(strict_types=1);

namespace Papyrus\Serializer\Test;

use Exception;
use Papyrus\Serializer\SerializationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SerializationFailedExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateException(): void
    {
        $exception = SerializationFailedException::create(new Exception('Fail'));

        self::assertSame('Failed (de)serialization: `Fail`', $exception->getMessage());
    }
}
