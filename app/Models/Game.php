<?php

declare(strict_types=1);

namespace App\Models;

use App\View\ViewGame;
use App\View\ViewGameResults;

class Game
{
    /**
     * First player.
     *
     * @var Player
     */
    private Player $firstPlayer_;

    /**
     * Second player.
     *
     * @var Player
     */
    private Player $secondPlayer_;

    /**
     * Number of tosses.
     *
     * @var int
     */
    private int $numberOfTosses_ = 1;

    /**
     * __construct Game.
     *
     * @param Player $firstPlayer
     * @param Player $secondPlayer
     */
    public function __construct(Player $firstPlayer, Player $secondPlayer)
    {
        $this->setFirstPlayer($firstPlayer);
        $this->setSecondPlayer($secondPlayer);
    }

    /**
     * Toss a coin.
     *
     * @return string
     */
    public function tossCoin(): string
    {
        return rand(0, 1) ? "eagle" : "tails";
    }

    /**
     * Start Game.
     *
     * @return void
     */
    public function startGame(): void
    {
        ViewGame::showPlayersChancesWinning(
            $this->getFirstPlayer()->getPlayerName(),
            $this->getFirstPlayer()->сalculatePlayersChancesOfWinning($this->getSecondPlayer()),
            $this->getSecondPlayer()->getPlayerName(),
            $this->getSecondPlayer()->сalculatePlayersChancesOfWinning($this->getFirstPlayer())
        );

        $this->startingGameProcess();
    }

    /**
     * Starting the game process.
     *
     * @return NULL
     */
    public function startingGameProcess(): NULL
    {
        while (true) {
            $this->tossCoin() == "eagle" ? $this->changeNumberOfCoinsForFirstPlayer() : $this->changeNumberOfCoinsForSecondPlayer();

            // If someone has 0 coins, then the game is over.
            if ($this->getFirstPlayer()->isPlayerBankrupt() || $this->getSecondPlayer()->isPlayerBankrupt()) {
                return $this->endGame();
            }

            $this->increaseNumberOfTosses();
        }
    }

    /**
     * Change the number of coins for the first player
     *
     * @return void
     */
    public function changeNumberOfCoinsForFirstPlayer(): void
    {
        $this->getFirstPlayer()->сhangeNumberOfCoinsPlayersHave($this->getSecondPlayer());
    }

    /**
     * Change the number of coins for the second player
     *
     * @return void
     */
    public function changeNumberOfCoinsForSecondPlayer(): void
    {
        $this->getSecondPlayer()->сhangeNumberOfCoinsPlayersHave($this->getFirstPlayer());
    }

    /**
     * Increase the number of tosses
     *
     * @return void
     */
    public function increaseNumberOfTosses(): void
    {
        $this->setNumberOfTosses($this->getNumberOfTosses()+1);
    }

    /**
     * Get a winner. The one with the most coins wins
     *
     * @return Player
     */
    public function getWinner(): Player
    {
        return $this->getFirstPlayer()->getNumberOfCoinsPlayerHas() > $this->getSecondPlayer()->getNumberOfCoinsPlayerHas() ? $this->getFirstPlayer() : $this->getSecondPlayer();
    }

    /**
     * End game.
     *
     * @return void
     */
    public function endGame(): void
    {
        ViewGameResults::showGameResults(
            $this->getFirstPlayer()->getPlayerName(),
            $this->getFirstPlayer()->getNumberOfCoinsPlayerHas(),
            $this->getSecondPlayer()->getPlayerName(),
            $this->getSecondPlayer()->getNumberOfCoinsPlayerHas(),
            $this->getWinner()->getPlayerName(),
            $this->getNumberOfTosses()
        );
    }

    /**
     * Get first player
     *
     * @return Player
     */
    public function getFirstPlayer(): Player
    {
        return $this->firstPlayer_;
    }

    /**
     * Set first player
     *
     * @param Player $firstPlayer_
     * @return void
     */
    public function setFirstPlayer(Player $firstPlayer_): void
    {
        $this->firstPlayer_ = $firstPlayer_;
    }

    /**
     * Get second player
     *
     * @return Player
     */
    public function getSecondPlayer(): Player
    {
        return $this->secondPlayer_;
    }

    /**
     * Set second player
     *
     * @param Player $secondPlayer_
     * @return void
     */
    public function setSecondPlayer(Player $secondPlayer_): void
    {
        $this->secondPlayer_ = $secondPlayer_;
    }

    /**
     * Get number of tosses
     *
     * @return int
     */
    public function getNumberOfTosses(): int
    {
        return $this->numberOfTosses_;
    }

    /**
     * Set number of tosses
     *
     * @param int $numberOfTosses_
     * @return void
     */
    public function setNumberOfTosses(int $numberOfTosses_): void
    {
        $this->numberOfTosses_ = $numberOfTosses_;
    }
}
