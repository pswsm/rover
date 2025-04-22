<?php

namespace App\Contexts\Rover\Domain\ValueObjects;

enum DirectionEnum: string
{
    case N = 'N';
    case S = 'S';
    case E = 'E';
    case W = 'W';

    public function turnLeft(): self
    {
        $directions = [self::N, self::W, self::S, self::E];
        $currentIndex = array_search($this, $directions);
        $newIndex = ($currentIndex - 1 + 4) % 4;
        return $directions[$newIndex];
    }

    public function turnRight(): self
    {
        $directions = [self::N, self::E, self::S, self::W];
        $currentIndex = array_search($this, $directions);
        $newIndex = ($currentIndex + 1) % 4;
        return $directions[$newIndex];
    }
}

