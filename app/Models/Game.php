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
    public Player $firstPlayer;

    /**
     * Second player.
     * @var Player
     */
    public Player $secondPlayer;

    /**
     * Количество подбрасований.
     * @var int
     */
    protected int $flips = 1;

    /**
     * __construct Game.
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->firstPlayer = $player1;
        $this->secondPlayer = $player2;
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
            $this->firstPlayer->getPlayerName(),
            $this->firstPlayer->сalculatePlayersChancesOfWinning($this->secondPlayer),
            $this->secondPlayer->getPlayerName(),
            $this->secondPlayer->сalculatePlayersChancesOfWinning($this->firstPlayer)
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
                $this->firstPlayer->сhangeNumberOfCoinsPlayersHave($this->secondPlayer);
            } else {
                $this->secondPlayer->сhangeNumberOfCoinsPlayersHave($this->firstPlayer);
            }

            // Если у кого-то кол-во монет будет 0, то игра окончена.
            if ($this->firstPlayer->isPlayerBankrupt() || $this->secondPlayer->isPlayerBankrupt()) {
                return $this->end();
            }

            $this->flips++;
        }
    }

    /**
     * Кто победитель?
     * Побеждает тот у кого больше монет.
     * @return Player
     */
    public function winner(): Player
    {
        return $this->firstPlayer->getNumberOfCoinsPlayerHas() > $this->secondPlayer->getNumberOfCoinsPlayerHas() ? $this->firstPlayer : $this->secondPlayer;
    }

    /**
     * Вывод результаты игры.
     * @return void
     */
    public function end(): void
    {
        echo <<<EOT
            Game over.

            {$this->firstPlayer->getPlayerName()}: {$this->firstPlayer->getNumberOfCoinsPlayerHas()} монет.
            {$this->secondPlayer->getPlayerName()}: {$this->secondPlayer->getNumberOfCoinsPlayerHas()} монет.

            Победитель: {$this->winner()->getPlayerName()}.

            Кол-во подбрасований: {$this->flips}.
        EOT;
    }
}
