<?php

class Player
{
    public string $name;
    public int $coins;

    public function __construct(string $name, int $coins)
    {
        $this->name = $name;
        $this->coins = $coins;
    }

    public function point(Player $player) : void
    {
        $this->coins++;
        $player->coins--;
    }

    public function bankrupt() : bool
    {
        return $this->coins == 0;
    }

    public function bank() : int
    {
        return $this->coins;
    }
}

class Game
{
    protected Player $player1;
    protected Player $player2;
    protected int $flips = 1;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function flip() : string
    {
        // Подбросить монету
        return rand(0, 1) ? "орел" : "решка"; 
    }

    public function start()
    {
        while(true){
            // Если орел, п1 получает монету, п2 теряет
            // Если решка п1 теряет монету, п2 получает
            if ($this->flip() == "орел") {
                $this->player1->point($this->player2);
            } else {
                $this->player2->point($this->player1);
            }

            // Если у кого-то кол-во монет будет 0, то игра окончена.
            if ($this->player1->bankrupt() || $this->player2->bankrupt()) {
                return $this->end();
            }

            $this->flips++;
        }
        
    }

    public function winner() : Player
    {
        //Победитель тот у кого больше монет.
        return $this->player1->bank() > $this->player2->bank() ? $this->player1 : $this->player2;
        
    }

    public function end() : void
    {
        echo <<<EOT
            Game over.

            {$this->player1->name}: {$this->player1->bank()}
            {$this->player2->name}: {$this->player2->bank()}

            Победитель: {$this->winner()->name}.

            Кол-во подбрасований: {$this->flips}.
        EOT;
    }
}

$game = new Game(
    new Player("Joe", 100),
    new Player("Jane", 100),
);

$game->start();