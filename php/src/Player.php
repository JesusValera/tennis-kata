<?php
declare(strict_types=1);

namespace TennisGame;

final class Player
{
    private const POINTS = ["Love", "Fifteen", "Thirty", "Forty"];

    private int $points = 0;

    public function __construct(private string $name){
    }

    public function name(): string
    {
        return $this->name;
    }

    public function points(): int
    {
        return $this->points;
    }

    public function score(): string
    {
        return self::POINTS[$this->points];
    }

    public function incrementPoint(): void
    {
        $this->points++;
    }
}
