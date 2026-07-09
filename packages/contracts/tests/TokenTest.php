<?php

declare(strict_types=1);

namespace Beacon\Tests;

use Beacon\Token;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psl\Type\Exception\AssertException;

class TokenTest extends TestCase
{
    #[Test]
    public function value_exposes_token_string(): void
    {
        $token = new Token('my-secret-token');

        static::assertSame('my-secret-token', $token->value);
    }

    #[Test]
    public function empty_token_throws_exception(): void
    {
        $this->expectException(AssertException::class);

        new Token('');
    }
}
