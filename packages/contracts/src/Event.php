<?php

declare(strict_types=1);

namespace Beacon;

use Psl\Type;

final readonly class Event
{
    /**
     * @param non-empty-string $topic
     * @param array<string, mixed> $data
     *
     * @throws Type\Exception\AssertException If the topic is empty or the data keys are not strings.
     */
    public function __construct(
        public string $topic,
        public array $data,
    ) {
        Type\non_empty_string()->assert($this->topic);
        Type\dict(Type\string(), Type\mixed())->assert($this->data);
    }
}
