<?php

declare(strict_types=1);

class Letter
{
    private string $word;
    private int $position;

    public string $value;
    public string $color = 'white';

    public function __construct(string $value, string $word, int $position)
    {
        $this->value = $value;
        $this->word = $word;
        $this->position = $position;

        $this->check();
    }

    private function isInWord(): bool
    {
        return false !== strpos($this->word, $this->value);
    }

    private function isInGoodPosition(): bool
    {
        return $this->value === str_split($this->word)[$this->position];
    }

    private function check(): void
    {
        if (!$this->isInWord()) {
            return;
        }
        $this->color = 'yellow';

        if (!$this->isInGoodPosition()) {
            return;
        }
        $this->color = 'red';
    }
}
