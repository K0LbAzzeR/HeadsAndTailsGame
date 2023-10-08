<?php

declare(strict_types=1);

namespace App\Models;

use App\View\ViewGame;

class Game
{
    /**
     * First player.
     * @var Player
     */
    public Player $firstPlayer_;

    /**
     * Second player.
     * @var Player
     */
    public Player $secondPlayer_;

    /**
     * Number of tosses.
     * @var int
     */
    protected int $numberOfTosses_ = 1;

    /**
     * __construct Game.
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->firstPlayer_ = $player1;
        $this->secondPlayer_ = $player2;
    }

    /**
     * Подбрасываем монету.
     * @return string
     */
    public function flip(): string
    {
        return rand(0, 1) ? "орел" : "решка";
    }

    /**
     * Start Game.
     * @return void
     */
    public function startGame(): void
    {
        ViewGame::showPlayersChancesWinning(
            $this->firstPlayer_->getPlayerName(),
            $this->firstPlayer_->сalculatePlayersChancesOfWinning($this->secondPlayer_),
            $this->secondPlayer_->getPlayerName(),
            $this->secondPlayer_->сalculatePlayersChancesOfWinning($this->firstPlayer_)
        );

        $this->play();
    }

    /**
     * Процесс игры.
     * @return NULL
     */
    public function play(): NULL
    {
        while (true) {
            // Если орел, п1 получает монету, п2 теряет
            // Если решка п1 теряет монету, п2 получает
            if ($this->flip() == "орел") {
                $this->firstPlayer_->сhangeNumberOfCoinsPlayersHave($this->secondPlayer_);
            } else {
                $this->secondPlayer_->сhangeNumberOfCoinsPlayersHave($this->firstPlayer_);
            }

            // Если у кого-то кол-во монет будет 0, то игра окончена.
            if ($this->firstPlayer_->isPlayerBankrupt() || $this->secondPlayer_->isPlayerBankrupt()) {
                return $this->end();
            }

            $this->numberOfTosses_++;
        }
    }

    /**
     * Кто победитель?
     * Побеждает тот у кого больше монет.
     * @return Player
     */
    public function winner(): Player
    {
        return $this->firstPlayer_->getNumberOfCoinsPlayerHas() > $this->secondPlayer_->getNumberOfCoinsPlayerHas() ? $this->firstPlayer_ : $this->secondPlayer_;
    }

    /**
     * Вывод результаты игры.
     * @return void
     */
    public function end(): void
    {
        echo <<<EOT
            Game over.

            {$this->firstPlayer_->getPlayerName()}: {$this->firstPlayer_->getNumberOfCoinsPlayerHas()} монет.
            {$this->secondPlayer_->getPlayerName()}: {$this->secondPlayer_->getNumberOfCoinsPlayerHas()} монет.

            Победитель: {$this->winner()->getPlayerName()}.

            Кол-во подбрасований: {$this->numberOfTosses_}.
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
