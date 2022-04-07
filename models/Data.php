<?php

require_once '../class/Player.php';

class Data {



  public function getPlayers(): array {
    $players = json_decode(file_get_contents('../data/players.json'));
    usort($players, function($a, $b) {
      return $a->score < $b->score;
    });

    return $players;
  }



  public function getPlayerById(int $id): Player {
    $playerSearch = array_filter($this->getPlayers(), function ($player) use (&$id) {
      return $player->id == $id;
    });

    return $this->factorisePlayer($playerSearch);
  }



  public function getPlayerByAttributes(string $name, string $code) {
    $playerSearch = array_filter($this->getPlayers(), function ($player) use (&$name, &$code) {
      return $player->name === $name && $player->code === $code;
    });

    return $this->factorisePlayer($playerSearch);
  }


  
  private function factorisePlayer(array $playerSearch) {
    if (empty($playerSearch)) return null;
    $playerDto = $playerSearch[array_keys($playerSearch)[0]];

    return new Player($playerDto);
  }
}