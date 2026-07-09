<?php

declare(strict_types=1);

namespace Beacon\Tests;

use Beacon\Event;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psl\Type\Exception\AssertException;

class EventTest extends TestCase
{
    #[Test]
    public function exposes_topic_and_data(): void
    {
        $event = new Event('user.created', ['id' => 42, 'name' => 'Dayvson']);

        static::assertSame('user.created', $event->topic);
        static::assertSame(['id' => 42, 'name' => 'Dayvson'], $event->data);
    }

    #[Test]
    public function empty_topic_throws_exception(): void
    {
        $this->expectException(AssertException::class);

        new Event('', ['id' => 42]);
    }

    #[Test]
    public function non_string_data_keys_throw_exception(): void
    {
        $this->expectException(AssertException::class);

        new Event('user.created', [0 => 'a', 1 => 'b']);
    }
}
