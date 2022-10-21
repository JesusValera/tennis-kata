<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private const POINTS = ["Love", "Fifteen", "Thirty", "Forty"];
    private const WIN = 'Win';
    private const THRESHOLD_TO_WIN = 4;
    private const MIN_WINNING_POINTS = 6;
    private const MIN_DIFFERENCE_OF_POINTS = 1;
    const ALL = "All";
    const DEUCE = "Deuce";
    const ADVANTAGE = "Advantage";
    private string $playerName1;
    private string $playerName2;

    private int $playerPoints1 = 0;
    private int $playerPoints2 = 0;

    public function __construct(string $playerName1, string $playerName2)
    {
        $this->playerName1 = $playerName1;
        $this->playerName2 = $playerName2;
    }

    public function getScore(): string
    {
        if ($this->isNormalGame()) {
            $s = self::POINTS[$this->playerPoints1];

            return $this->isDeuce()
                ? sprintf('%s-%s', $s, self::ALL)
                : sprintf("%s-%s", $s, self::POINTS[$this->playerPoints2]);
        }

        if ($this->isDeuce()) {
            return self::DEUCE;
        }

        $s = $this->playerPoints1 > $this->playerPoints2
            ? $this->playerName1
            : $this->playerName2;

        if ($this->isAdvantage()) {
            return sprintf('%s %s', self::ADVANTAGE, $s);
        }

        return sprintf('%s for %s', self::WIN, $s);
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === $this->playerName1) {
            $this->playerPoints1++;
            return;
        }

        $this->playerPoints2++;
    }

    private function isNormalGame(): bool
    {
        return $this->playerPoints1 < self::THRESHOLD_TO_WIN && $this->playerPoints2 < self::THRESHOLD_TO_WIN
            && !($this->playerPoints1 + $this->playerPoints2 === self::MIN_WINNING_POINTS);
    }

    private function isDeuce(): bool
    {
        return $this->playerPoints1 === $this->playerPoints2;
    }

    private function isAdvantage(): bool
    {
        return abs($this->playerPoints1 - $this->playerPoints2) === self::MIN_DIFFERENCE_OF_POINTS;
    }
}
