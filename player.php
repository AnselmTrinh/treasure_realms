<?php
// player is inherited from 
class Player extends Characters {
    public float $experience;

  public function message() {
    echo "Je ne faiblirai pas devant toi !";
  }
   // retourne l'experience du joueur actuelle
 public function get_experience()
 {
   return $this->experience;
 }

    // retourne l'experience du joueur actuelle
    public function set_experience($expValue)
    {
      $this->experience=$expValue;
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
