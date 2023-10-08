<?php

declare(strict_types=1);

namespace App\View;

class ViewGame
{
    /**
     * Show the player's chances of winning
     *
     * @param string $firstPlayerName First player name
     * @param float $firstPlayersChanceOfWinning First player's chance of winning
     * @param string $secondPlayerName Second player name
     * @param float $secondPlayersChanceOfWinning Second player's chance of winning
     * @return void
     */
    public static function showPlayersChancesWinning(
        string $firstPlayerName,
        float $firstPlayersChanceOfWinning,
        string $secondPlayerName,
        float $secondPlayersChanceOfWinning,
    ): void {
        echo <<<EOT
        {$firstPlayerName} chances of winning: {$firstPlayersChanceOfWinning}%.
        {$secondPlayerName} chances of winning: {$secondPlayersChanceOfWinning}%.
        EOT;
    }
}
