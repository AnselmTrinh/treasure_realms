<?php
// player is inherited from 
class Player extends Characters {
  public function message() {
    echo "Je ne faiblirai pas devant toi !";
  }
  public function move($keyPress) {
switch ($keyPress) {
    case 'UP':
        echo "le joueur se dirige en haut";
        break;
    case 'DOWN':
        echo "le joueur se dirige en bas";
        break;
    case 'LEFT':
        echo "le joueur se dirige à gauche";
    case 'RIGHT':
        echo "le joueur se dirige à droite";
    break;
    default:
        # code...
        break;
}

    echo "le joueur avance";
  }
}
?>