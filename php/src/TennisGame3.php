<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private const POINTS = ["Love", "Fifteen", "Thirty", "Forty"];

    private const THRESHOLD_TO_WIN = 4;
    private const MIN_WINNING_POINTS = 6;
    private const MIN_DIFFERENCE_OF_POINTS = 1;

    private const ALL = "All";
    private const DEUCE = "Deuce";
    private const ADVANTAGE = "Advantage";
    private const WIN = 'Win';

    private const FORMAT_DISPLAY_POINTS = '%s-%s';

    private Player $player1;
    private Player $player2;

    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1 = new Player($player1Name);
        $this->player2 = new Player($player2Name);
    }

    public function getScore(): string
    {
        if ($this->isNormalGame()) {
            if ($this->isDeuce()) {
                return sprintf(self::FORMAT_DISPLAY_POINTS, self::POINTS[$this->player1->points()], self::ALL);
            }

            return sprintf(self::FORMAT_DISPLAY_POINTS, $this->player1->score(), $this->player2->score());
        }

        if ($this->isDeuce()) {
            return self::DEUCE;
        }

        if ($this->isAdvantage()) {
            return sprintf('%s %s', self::ADVANTAGE, $this->currentWinningPlayer());
        }

        return sprintf('%s for %s', self::WIN, $this->currentWinningPlayer());
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === $this->player1->name()) {
            $this->player1->incrementPoint();
            return;
        }

        $this->player2->incrementPoint();
    }

    private function isNormalGame(): bool
    {
        return $this->player1->points() < self::THRESHOLD_TO_WIN && $this->player2->points() < self::THRESHOLD_TO_WIN
            && !($this->player1->points() + $this->player2->points() === self::MIN_WINNING_POINTS);
    }

    private function isDeuce(): bool
    {
        return $this->player1->points() === $this->player2->points();
    }

    private function isAdvantage(): bool
    {
        return abs($this->player1->points() - $this->player2->points()) === self::MIN_DIFFERENCE_OF_POINTS;
    }

    private function currentWinningPlayer(): string
    {
        return $this->player1->points() > $this->player2->points()
            ? $this->player1->name()
            : $this->player2->name();
    }
}
