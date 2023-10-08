<?php

declare(strict_types=1);

namespace App\Controller;

use App\Models\Game;
use App\Models\Player;

class Main
{
    /**
     * Launching the application
     * @return void
     */
    public static function launchingApplication(): void
    {
        $game = new Game(
            new Player("Joe", 10000),
            new Player("Jane", 100),
        );

        $game->startGame();
    }
}
