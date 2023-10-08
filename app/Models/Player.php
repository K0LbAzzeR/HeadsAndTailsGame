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
     * Change the number of coins players have.
     * @param Player $player Player
     * @return void
     */
    public function сhangeNumberOfCoinsPlayersHave(Player $player): void
    {
        $this->setNumberOfCoinsPlayerHas($this->getNumberOfCoinsPlayerHas() + 1);
        $player->setNumberOfCoinsPlayerHas($player->getNumberOfCoinsPlayerHas() - 1);
    }

    /**
     * Player bankrupt.
     * @return bool
     */
    public function isPlayerBankrupt(): bool
    {
        return $this->getNumberOfCoinsPlayerHas() == 0;
    }

    /**
     * Шанс победы у игрока.
     * @param Player $player
     * @return float
     */
    public function odds(Player $player): float
    {
        return round($this->getNumberOfCoinsPlayerHas() / ($this->getNumberOfCoinsPlayerHas() + $player->getNumberOfCoinsPlayerHas()) * 100, 2);
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
