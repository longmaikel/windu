<?php

namespace Longmaikel\Test\Windu\Framework;

use Longmaikel\Test\Windu\Framework\Constraint\StringContainStringOccurrences;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class TestCase extends MockeryTestCase
{
    public static function assertStringContainsStringOnce(string $needle, string $haystack, string $message = ''): void
    {
        static::assertStringContainsStringOccurrenceEqual($needle, $haystack, 1, $message);
    }

    public static function assertStringContainsStringTwice(string $needle, string $haystack, string $message = ''): void
    {
        static::assertStringContainsStringOccurrenceEqual($needle, $haystack, 2, $message);
    }

    public static function assertStringContainsStringOccurrenceEqual(string $needle, string $haystack, int $occurrences = 1, string $message = ''): void
    {

        $constraint = new StringContainStringOccurrences($needle, 1, false);

        static::assertThat($haystack, $constraint, $message);
    }

}