<?php

namespace App\Contexts\Rover\Domain\ValueObjects;

class IntValueObject {
    private int $value;

    public function getValue(): int {
        return $this->x;
    }

    public function equals(IntValueObject $other): bool {
        return $this->x == $other->x;
    }
}
