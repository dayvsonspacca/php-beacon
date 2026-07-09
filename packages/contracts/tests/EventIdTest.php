<?php

declare(strict_types=1);

namespace Beacon\Tests;

use Beacon\EventId;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psl\Type\Exception\AssertException;

class EventIdTest extends TestCase
{
    #[Test]
    public function value_returns_id_string(): void
    {
        $id = new EventId('550e8400-e29b-41d4-a716-446655440000');

        static::assertSame('550e8400-e29b-41d4-a716-446655440000', $id->value);
    }

    #[Test]
    public function empty_id_throws_exception(): void
    {
        $this->expectException(AssertException::class);

        new EventId('');
    }
}
