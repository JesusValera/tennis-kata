<?php

namespace TennisGame;

interface TennisGame
{
    public function wonPoint(string $playerName): void;

    /**
     * @return string
     */
    public function getScore();
}
