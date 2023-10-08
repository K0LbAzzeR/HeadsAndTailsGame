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
     * Number of coins the player has.
     * @var int
     */
    private int $numberOfCoinsPlayerHas_;

    /**
     * __construct Player.
     *
     * @param string $playerName Player name
     * @param int $numberOfCoinsPlayerHas Number of coins the player has
     */
    public function __construct(string $playerName, int $numberOfCoinsPlayerHas)
    {
        $this->setPlayerName($playerName);
        $this->setNumberOfCoinsPlayerHas($numberOfCoinsPlayerHas);
    }

    /**
     * Изменение количества монет у игроков.
     * @param Player $player
     * @return void
     */
    public function point(Player $player): void
    {
        $this->numberOfCoinsPlayerHas_++;
        $player->numberOfCoinsPlayerHas_--;
    }

    /**
     * Проверка на банкротсво игрока.
     * @return bool
     */
    public function bankrupt(): bool
    {
        return $this->numberOfCoinsPlayerHas_ == 0;
    }

    /**
     * Количество монет у игрока.
     * @return int
     */
    public function bank(): int
    {
        return $this->numberOfCoinsPlayerHas_;
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

    /**
     * Get player name
     *
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->playerName_;
    }

    /**
     * Set player name
     *
     * @param string $playerName
     * @return void
     */
    public function setPlayerName(string $playerName): void
    {
        $this->playerName_ = $playerName;
    }

    /**
     * Get number of coins the player has
     *
     * @return int
     */
    public function getNumberOfCoinsPlayerHas(): int
    {
        return $this->numberOfCoinsPlayerHas_;
    }

    /**
     * Set number of coins the player has
     *
     * @param int $numberOfCoinsPlayerHas
     * @return void
     */
    public function setNumberOfCoinsPlayerHas(int $numberOfCoinsPlayerHas): void
    {
        $this->numberOfCoinsPlayerHas_ = $numberOfCoinsPlayerHas;
    }
}
