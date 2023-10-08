<?php

declare(strict_types=1);

namespace App\Models;

class Player
{
    /**
     * Player name.
     * @var string
     */
    private string $playerName_;

    /**
     * Количество монет у игрока.
     * @var int
     */
    public int $coins;

    /**
     * Инициализация игрока.
     * @param string $name
     * @param int $coins
     */
    public function __construct(string $playerName, int $coins)
    {
        $this->setPlayerName($playerName);
        $this->coins = $coins;
    }

    /**
     * Изменение количества монет у игроков.
     * @param Player $player
     * @return void
     */
    public function point(Player $player): void
    {
        $this->coins++;
        $player->coins--;
    }

    /**
     * Проверка на банкротсво игрока.
     * @return bool
     */
    public function bankrupt(): bool
    {
        return $this->coins == 0;
    }

    /**
     * Количество монет у игрока.
     * @return int
     */
    public function bank(): int
    {
        return $this->coins;
    }

    /**
     * Шанс победы у игрока.
     * @param Player $player
     * @return float
     */
    public function odds(Player $player): float
    {
        return round($this->bank() / ($this->bank() + $player->bank()) * 100, 2);
    }

    public function getPlayerName(): string
    {
        return $this->playerName_;
    }

    public function setPlayerName(string $playerName_): void
    {
        $this->playerName_ = $playerName_;
    }
}
