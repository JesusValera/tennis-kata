<?php
declare(strict_types=1);

namespace TennisGame;

final class Player
{
    private const POINTS = ["Love", "Fifteen", "Thirty", "Forty"];

    private const MIN_DIFFERENCE_OF_POINTS = 1;
    private const THRESHOLD_TO_WIN = 4;
    private const MIN_WINNING_POINTS = 6;

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

    public function wonAPoint(): void
    {
        $this->points++;
    }

    public function hasAdvantage(Player $otherPlayer): bool
    {
        return abs($this->points - $otherPlayer->points) === self::MIN_DIFFERENCE_OF_POINTS;
    }

    public function isDeuce(Player $otherPlayer): bool
    {
        return $this->points === $otherPlayer->points;
    }

    public function isPlayingAGame(Player $otherPlayer): bool
    {
        return $this->points < self::THRESHOLD_TO_WIN && $otherPlayer->points < self::THRESHOLD_TO_WIN
        && !($this->points + $otherPlayer->points === self::MIN_WINNING_POINTS);
    }

    public function playerWinning(Player $otherPlayer): string
    {
        return $this->points > $otherPlayer->points?
            $this->name
            : $otherPlayer->name;
    }
}
