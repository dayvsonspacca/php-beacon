<?php

declare(strict_types=1);

namespace Beacon;

use Psl\Type;

final readonly class EventId
{
    /**
     * @throws Type\Exception\AssertException If the id is an empty string.
     */
    public function __construct(
        public string $value,
    ) {
        Type\non_empty_string()->assert($this->value);
    }
}
