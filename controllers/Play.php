<?php

declare(strict_types=1);

class Play extends Controller
{
    private Game $game;

    public function __construct()
    {
        $this->game = new Game();
    }

    public function index(): void
    {
        $this->render('play', [
            'game' => $this->game,
        ]);
    }

    public function submit(): void
    {
        $inputs = $this->cleanInputs($_POST);
        $letters = [];

        foreach ($inputs as $position => $value) {
            $letters[] = new Letter(strtoupper($value), $this->game->word, $position);
        }

        $this->game->trials[] = $letters;
        $this->game->setState();
        $this->game->save();

        $this->index();
    }

    private function cleanInputs(array $inputs): array
    {
        $cleanInputs = [];
        foreach ($inputs as $input) {
            $cleanInputs[] = $this->clean($input);
        }

        return $cleanInputs;
    }
}
