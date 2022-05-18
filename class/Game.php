<?php

declare(strict_types=1);

class Game
{
    private Memory $memory;
    public string $word;
    public string $state;
    public array $trials;

    public function __construct()
    {
        $this->memory = new Memory();
        $gameInMemory = $this->memory->get('game');

        if (!$gameInMemory) {
            $this->init();

            return;
        }

        $this->word = $gameInMemory->word;
        $this->state = $gameInMemory->state;
        $this->trials = $gameInMemory->trials;
    }

    public function init(): void
    {
        $this->word = $this->memory->getRandomWord();
        $this->state = 'progress';
        $this->trials = [];
    }

    public function save(): void
    {
        $this->memory->set('game', get_object_vars($this));
    }

    public function setState(): void
    {
        if ($this->isWinning()) {
            $this->state = 'win';

            return;
        }

        if ($this->isLoosing()) {
            $this->state = 'lose';
        }
    }

    private function isWinning(): bool
    {
        foreach (end($this->trials) as $letter) {
            if ('red' !== $letter->color) {
                return false;
            }
        }

        $player = new Player();
        if ($player->name) {
            $player->save(count($this->trials));
        }

        return true;
    }

    private function isLoosing(): bool
    {
        return count($this->trials) > 5;
    }
}
