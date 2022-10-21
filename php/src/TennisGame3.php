<?php

declare(strict_types = 1);

namespace TennisGame;

class TennisGame3 implements TennisGame
{
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
            $p = ["Love", "Fifteen", "Thirty", "Forty"];
            $s = $p[$this->playerPoints1];

            return ($this->isDeuce())
                ? "{$s}-All"
                : "{$s}-{$p[$this->playerPoints2]}";
        }

        if ($this->isDeuce()) {
            return "Deuce";
        }

        $s = $this->playerPoints1 > $this->playerPoints2 ? $this->playerName1 : $this->playerName2;

        if ($this->isAdvantage()) {
            return "Advantage {$s}";
        }

        return "Win for {$s}";
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === "player1") {
            $this->playerPoints1++;
        } else {
            $this->playerPoints2++;
        }
    }

    private function isNormalGame(): bool
    {
        return $this->playerPoints1 < 4 && $this->playerPoints2 < 4 && !($this->playerPoints1 + $this->playerPoints2 === 6);
    }

    private function isDeuce(): bool
    {
        return $this->playerPoints1 == $this->playerPoints2;
    }

    private function isAdvantage(): bool
    {
        return ($this->playerPoints1 - $this->playerPoints2) * ($this->playerPoints1 - $this->playerPoints2) == 1;
    }
}
