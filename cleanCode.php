<?php

class Game {

   public function save(string $name, Game $value): void {
      setcookie($name, serialize($value));
   }

   public function load(string $name): mixed {
      return unserialize($_COOKIE[$name]);
   }
}