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

    public function start()
    {
        
        while(true){
            // Подбросить монету
            $flip = rand(0, 1) ? "орел" : "решка";

            // Если орел, п1 получает монету, п2 теряет
            // Если решка п1 теряет монету, п2 получает
            if ($flip == "орел") {
                $this->player1->coins++;
                $this->player2->coins--;
            } else {
                $this->player1->coins--;
                $this->player2->coins++;
            }

            // Если у кого-то кол-во монет будет 0, то игра окончена.
            if ($this->player1->coins == 0 || $this->player2->coins == 0) {
                return $this->end();
            }

            $this->flips++;
        }
        
    }

    public function winner()
    {
        //Победитель тот у кого больше монет.
        if ($this->player1->coins > $this->player2->coins) {
            return $this->player1;
        } else {
            return $this->player2;
        }
        
    }

    public function end() : void
    {
        echo <<<EOT
            Game over.

            {$this->player1->name}: {$this->player1->coins}
            {$this->player2->name}: {$this->player2->coins}

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