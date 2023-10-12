<?php

declare(strict_types=1);

namespace App\View;

class ViewGameResults
{
    /**
     * Show game results
     *
     * @param string $firstPlayerName First player name
     * @param int $numberOfCoinsFirstPlayerHas Number of coins first player has
     * @param string $secondPlayerName Second player name
     * @param int $numberOfCoinsSecondPlayerHas Number of coins second player has
     * @param string $winnerPlayerName Winner player name
     * @param int $numberOfTosses Number of tosses
     * @return void
     */
    public static function showGameResults(
        string $firstPlayerName,
        int $numberOfCoinsFirstPlayerHas,
        string $secondPlayerName,
        int $numberOfCoinsSecondPlayerHas,
        string $winnerPlayerName,
        int $numberOfTosses
    ): void
    {
        echo <<<EOT
            Game over.

            {$firstPlayerName}: {$numberOfCoinsFirstPlayerHas} coins.
            $secondPlayerName}: {$numberOfCoinsSecondPlayerHas} coins.

            Winner: {$winnerPlayerName}.

            Number of tosses: {$numberOfTosses}.
        EOT;
    }
}