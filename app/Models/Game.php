<?php

declare(strict_types=1);

namespace App\Models;

use App\View\ViewGame;

class Game
{
    /**
     * Игрок номер один.
     * @var Player
     */
    public Player $player1;

    /**
     * Игрок номер два.
     * @var Player
     */
    public Player $player2;

    /**
     * Количество подбрасований.
     * @var int
     */
    protected int $flips = 1;

    /**
     * Инициализация игры.
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
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
            $this->player1->getPlayerName(),
            $this->player1->odds($this->player2),
            $this->player2->getPlayerName(),
            $this->player2->odds($this->player1)
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
                $this->player1->сhangeNumberOfCoinsPlayersHave($this->player2);
            } else {
                $this->player2->сhangeNumberOfCoinsPlayersHave($this->player1);
            }

            // Если у кого-то кол-во монет будет 0, то игра окончена.
            if ($this->player1->isPlayerBankrupt() || $this->player2->isPlayerBankrupt()) {
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
        return $this->player1->getNumberOfCoinsPlayerHas() > $this->player2->getNumberOfCoinsPlayerHas() ? $this->player1 : $this->player2;
    }

    /**
     * Вывод результаты игры.
     * @return void
     */
    public function end(): void
    {
        echo <<<EOT
            Game over.

            {$this->player1->getPlayerName()}: {$this->player1->getNumberOfCoinsPlayerHas()} монет.
            {$this->player2->getPlayerName()}: {$this->player2->getNumberOfCoinsPlayerHas()} монет.

            Победитель: {$this->winner()->getPlayerName()}.

            Кол-во подбрасований: {$this->flips}.
        EOT;
    }
}
