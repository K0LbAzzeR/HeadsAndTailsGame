<?php

declare(strict_types=1);

namespace App\Models;

use App\View\ViewGame;

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
            if ($this->tossCoin() == "eagle") {
                $this->getFirstPlayer()->сhangeNumberOfCoinsPlayersHave($this->getSecondPlayer());
            } else {
                $this->getSecondPlayer()->сhangeNumberOfCoinsPlayersHave($this->getFirstPlayer());
            }

            // Если у кого-то кол-во монет будет 0, то игра окончена.
            if ($this->getFirstPlayer()->isPlayerBankrupt() || $this->getSecondPlayer()->isPlayerBankrupt()) {
                return $this->end();
            }

            $this->setNumberOfTosses($this->getNumberOfTosses()+1);
        }
    }

    /**
     * Кто победитель?
     * Побеждает тот у кого больше монет.
     *
     * @return Player
     */
    public function winner(): Player
    {
        return $this->getFirstPlayer()->getNumberOfCoinsPlayerHas() > $this->getSecondPlayer()->getNumberOfCoinsPlayerHas() ? $this->getFirstPlayer() : $this->getSecondPlayer();
    }

    /**
     * Вывод результаты игры.
     *
     * @return void
     */
    public function end(): void
    {
        echo <<<EOT
            Game over.

            {$this->getFirstPlayer()->getPlayerName()}: {$this->getFirstPlayer()->getNumberOfCoinsPlayerHas()} монет.
            {$this->getSecondPlayer()->getPlayerName()}: {$this->getSecondPlayer()->getNumberOfCoinsPlayerHas()} монет.

            Победитель: {$this->winner()->getPlayerName()}.

            Кол-во подбрасований: {$this->getNumberOfTosses()}.
        EOT;
    }

    /**
     * @return Player
     */
    public function getFirstPlayer(): Player
    {
        return $this->firstPlayer_;
    }

    /**
     * @param Player $firstPlayer_
     * @return void
     */
    public function setFirstPlayer(Player $firstPlayer_): void
    {
        $this->firstPlayer_ = $firstPlayer_;
    }

    /**
     * @return Player
     */
    public function getSecondPlayer(): Player
    {
        return $this->secondPlayer_;
    }

    /**
     * @param Player $secondPlayer_
     * @return void
     */
    public function setSecondPlayer(Player $secondPlayer_): void
    {
        $this->secondPlayer_ = $secondPlayer_;
    }

    /**
     * @return int
     */
    public function getNumberOfTosses(): int
    {
        return $this->numberOfTosses_;
    }

    /**
     * @param int $numberOfTosses_
     * @return void
     */
    public function setNumberOfTosses(int $numberOfTosses_): void
    {
        $this->numberOfTosses_ = $numberOfTosses_;
    }
}
