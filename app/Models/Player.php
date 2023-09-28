<?php

class Player
{
    public string $name;
    public int $coins;

    public function __construct(string $name, int $coins)
    {
        $this->name = $name;
        $this->coins = $coins;
    }

    public function point(Player $player) : void
    {
        $this->coins++;
        $player->coins--;
    }

    public function bankrupt() : bool
    {
        return $this->coins == 0;
    }

    public function bank() : int
    {
        return $this->coins;
    }

    public function odds(Player $player) : float
    {
        return round($this->bank() / ($this->bank() + $player->bank()) * 100, 2);
    }
}