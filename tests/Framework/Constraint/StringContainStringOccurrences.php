<?php

namespace Longmaikel\Test\Windu\Framework\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

final class StringContainStringOccurrences extends Constraint
{

    private string $string;
    private bool $ignoreCase;
    private int $occurrences;

    public function __construct(string $string, int $occurrences = 1, bool $ignoreCase = false)
    {
        $this->string = $string;
        $this->occurrences = $occurrences;
        $this->ignoreCase = $ignoreCase;
    }
    public function toString(): string
    {
        if ($this->ignoreCase) {
            $string = mb_strtolower($this->string, 'UTF-8');
        } else {
            $string = $this->string;
        }

        return sprintf(
            'contains %d %s of "%s"',
            $this->occurrences,
            $this->occurrences === 1 ? 'occurrence' : 'occurrences',
            $string
        );
    }

    protected function matches($other): bool
    {
        return $this->ignoreCase ?
            $this->occurrences === mb_substr_count($other, $this->string, 'UTF-8')
            : $this->occurrences === substr_count($other, $this->string);
    }
}