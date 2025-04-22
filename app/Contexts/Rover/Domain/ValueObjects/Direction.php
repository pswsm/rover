<?php

namespace App\Contexts\Rover\Domain\ValueObjects;

class Direction
{
    private const ALLOWED_DIRECTIONS = ['N', 'S', 'E', 'W'];

    private string $value;

    private function __construct(string $value)
    {
        if (!in_array($value, self::ALLOWED_DIRECTIONS)) {
            throw new \InvalidArgumentException('Invalid direction: ' . $value);
        }
        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(Direction $other): bool
    {
        return $this->value === $other->toString();
    }
}

