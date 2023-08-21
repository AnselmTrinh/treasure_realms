<?php
class Characters
{
  public $positionX;
  public $positionY;
  public $health;
  public float $experience;
  public int $result;
  public $force;
  public function __construct($health, $force, $posX, $posY)
  {
    $this->health = $health;
    $this->force = $force;
    $this->positionX = $posX;
    $this->positionY = $posY;
  }
  // retourne la vie actuelle
  public function get_health()
  {
    return $this->health;
  }
  // retourne la force actuelle
  public function get_force()
  {
    return $this->force;
  }
  // retourne la position abscisse actuelle
  public function get_positionX()
  {
    return $this->positionX;
  }
  // retourne la position ordonnée actuelle
  public function get_positionY()
  {
    return $this->positionY;
  }

/*
*@desc: défini la vie
*@param: $healthValue : int
*/
public function set_health($healthValue){
  $this->health=$healthValue;
}
/*
*@desc: défini la force
*@param: $forceValue : int
*/
public function set_force($forceValue){
  $this->force=$forceValue;
}
/*
*@desc: défini la position en abscisse
*@param: $positionValue : int
*/
public function set_positionX($positionValue){
  $this->positionX=$positionValue;
}
/*
*@desc: défini la position en ordonnées
*@param: $positionValue : int
*/
public function set_positionY($positionValue){
  $this->positionY=$positionValue;
}
  /*
  *@desc: Combat l'ennemy 
  *@param : healthEnemy : int
  *@return : booleen : true si le combat est possible  car HP restant de l'adversaire sinon retourne false
  */
  public function fight($healthEnnemy)
  {
    if ($healthEnnemy >= 0) {
      $result  = ($this->health - $healthEnnemy);
      return true;
    } else {
      echo "Aucune cible selectionnée !";
      return false;
    }
  }
}
