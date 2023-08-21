<?php
class Characters {
  public $health;
  public $force;
  public function __construct($health, $force) {
    $this->health = $health;
    $this->force = $force;
  }
  public function fight() {
    echo "The char get {$this->health} and the color is {$this->force}.";
  }
}
?>