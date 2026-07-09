<?php

declare(strict_types=1);

namespace Beacon;

use Psl\Type;
use SensitiveParameter;

final readonly class Token
{
    /**
     * @throws Type\Exception\AssertException If the token is an empty string.
     */
    public function __construct(
        #[SensitiveParameter]
        public string $value,
    ) {
        Type\non_empty_string()->assert($this->value);
    }
}
