<?php

namespace TennisGame;

class TennisGame3 implements TennisGame
{
    private $p2 = 0;
    private $p1 = 0;
    private $p1N = '';
    private $p2N = '';

    public function __construct($p1N, $p2N)
    {
        $this->p1N = $p1N;
        $this->p2N = $p2N;
    }

    public function getScore(): string
    {
        if ($this->isNormalGame()) {
            $p = array("Love", "Fifteen", "Thirty", "Forty");
            $s = $p[$this->p1];

            return ($this->isDeuce())
                ? "{$s}-All"
                : "{$s}-{$p[$this->p2]}";
        }

        if ($this->isDeuce()) {
            return "Deuce";
        }

        $s = $this->p1 > $this->p2 ? $this->p1N : $this->p2N;

        if ($this->isAdvantage()) {
            return "Advantage {$s}";
        }

        return "Win for {$s}";
    }

    public function wonPoint($playerName): void
    {
        if ($playerName === "player1") {
            $this->p1++;
        } else {
            $this->p2++;
        }
    }

    private function isNormalGame(): bool
    {
        return $this->p1 < 4 && $this->p2 < 4 && !($this->p1 + $this->p2 === 6);
    }

    private function isDeuce(): bool
    {
        return $this->p1 == $this->p2;
    }

    private function isAdvantage(): bool
    {
        return ($this->p1 - $this->p2) * ($this->p1 - $this->p2) == 1;
    }
}
