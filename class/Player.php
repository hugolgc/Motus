<?php

declare(strict_types=1);

class Player
{
    public $name;
    public $score;
    private array $points = [25, 18, 12, 8, 4, 2];
    private Memory $memory;

    public function __construct($name = null)
    {
        $this->memory = new Memory();

        if (!$name) {
            $this->getFromMemory();

            return;
        }

        $this->name = $name;
        $this->setInMemory($name);
    }

    public function save(int $trials): void
    {
        $playersStandings = $this->memory->getPlayersStandings();
        $points = $this->points[$trials];
        $name = $this->name;

        $players = array_filter($playersStandings, function ($player) use (&$name) {
            if ($player->name === $name) {
                return $player;
            }
        });

        if (!empty($players) && isset($players[array_keys($players)[0]])) {
            $player = $players[array_keys($players)[0]];
            $playersStandings[array_search($player, $playersStandings, true)]->score = $player->score + $points;
            $this->memory->setPlayers($playersStandings);

            return;
        }

        $this->score = $points;
        $playersStandings[] = get_object_vars($this);
        $this->memory->setPlayers($playersStandings);
    }

    private function getFromMemory(): void
    {
        $this->name = $this->memory->get('player');
    }

    private function setInMemory(): void
    {
        $this->memory->set('player', $this->name);
    }
}
