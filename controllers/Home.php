<?php

class Home extends Controller {

  public function lobby(): void {
    $player = new Player();
    $memory = new Memory();
    
    $playersStandings = $memory->getPlayersStandings();

    $this->render('home', [
      'player' => $player,
      'playersStandings' => $playersStandings
    ]);
  }

  public function createGame(): void {
    $game = new Game();
    $game->init();
    $game->save();

    new Player($this->clean($_POST['name']));

    header('location: /play');
  }
}