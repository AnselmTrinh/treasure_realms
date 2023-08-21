<?php
class Characters {
  public $health;
  public int $result;
  public $force;
  public function __construct($health, $force) {
    $this->health = $health;
    $this->force = $force;
  }
  /*
  *@desc: Combat l'ennemy 
  *@param : healthEnemy : int
  *@return : booleen : true si le combat est possible  car HP restant de l'adversaire sinon retourne false
  */
  public function fight($healthEnnemy) {
    if ($healthEnnemy>=0){
      $result  =($this->health-$healthEnnemy);
      return true;
    }else{
      echo "Aucune cible selectionnée !";
      return false;
    }
  }
}
