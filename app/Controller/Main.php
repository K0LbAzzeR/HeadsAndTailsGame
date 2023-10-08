<?php

declare(strict_types=1);

namespace App\Controller;

use App\Models\Game;
use App\Models\Player;
class Main
{
    public static function run(): void
    {
        $game = new Game(
            new Player("Joe", 10000),
            new Player("Jane", 100),
        );

        $game->startGame();
    }
}