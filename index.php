<?php

declare(strict_types=1);

include_once 'app/Models/Player.php';
include_once 'app/Models/Game.php';

$game = new Game(
    new Player("Joe", 10000),
    new Player("Jane", 100),
);

$game->start();
