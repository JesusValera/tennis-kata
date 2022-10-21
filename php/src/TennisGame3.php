<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private const ALL = "All";
    private const DEUCE = "Deuce";
    private const ADVANTAGE = "Advantage";
    private const WIN = 'Win';

    private const FORMAT_POINTS = '%s-%s';
    private const FORMAT_ADVANTAGE = '%s %s';
    private const FORMAT_WON = '%s for %s';

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
                return $this->printScore(self::FORMAT_POINTS, $this->player1->score(), self::ALL);
            }
            return $this->printScore(self::FORMAT_POINTS, $this->player1->score(), $this->player2->score());
        }

        if ($this->isDeuce()) {
            return self::DEUCE;
        }

        if ($this->isAdvantage()) {
            return $this->printScore(self::FORMAT_ADVANTAGE, self::ADVANTAGE, $this->currentWinningPlayer());
        }

        return $this->printScore(self::FORMAT_WON, self::WIN, $this->currentWinningPlayer());
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === $this->player1->name()) {
            $this->player1->wonAPoint();
            return;
        }

        $this->player2->wonAPoint();
    }

    private function isNormalGame(): bool
    {
        return $this->player1->isPlayingAGame($this->player2);
    }

    private function isDeuce(): bool
    {
        return $this->player1->isDeuce($this->player2);
    }

    private function isAdvantage(): bool
    {
        return $this->player1->hasAdvantage($this->player2);
    }

    private function currentWinningPlayer(): string
    {
        return $this->player1->playerWinning($this->player2);
    }

    private function printScore(string $format, string $score1, string $score2): string
    {
        return sprintf($format, $score1, $score2);
    }
}
