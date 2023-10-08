<?php

declare(strict_types=1);

include_once __DIR__ . "/vendor/autoload.php";

use App\Models\Game;
use App\Models\Player;

$game = new Game(
    new Player("Joe", 10000),
    new Player("Jane", 100),
);

$game->start();
