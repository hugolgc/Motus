<?php

declare(strict_types=1);

class Memory
{
    private const PLAYERS_FILE = '../data/players.json';

    public function get(string $name)
    {
        return isset($_COOKIE[$name]) ? json_decode(stripslashes($_COOKIE[$name])) : null;
    }

    public function set(string $name, $value): void
    {
        setcookie($name, json_encode($value));
    }

    public function getPlayersStandings(): array
    {
        $players = json_decode(file_get_contents(self::PLAYERS_FILE));

        usort($players, function ($a, $b) {
            return $a->score <=> $b->score; // on veut -1 si a est plus petit, 0 si égal, 1 si plus grand. le spaceship operator sers à ça :)
        });

        return $players;
    }

    public function setPlayers(array $players): void
    {
        file_put_contents(self::PLAYERS_FILE, json_encode($players));
    }

    public function getRandomWord(): string
    {
        $words = file('../data/dictionary.txt', \FILE_IGNORE_NEW_LINES);

        return $words[array_rand($words)];
    }
}
