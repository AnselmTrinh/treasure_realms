<?php
class Player
{
    private $health;
    private $force;
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->health=100;
        $this->force=100;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }
    public function getForce()
    {
        return $this->force;
    }
    public function getHealth()
    {
        return $this->health;
    }
    public function setHealth($value){
        $this->health=$value;
    }

    public function setForce($value){
        $this->force=$value;
    }
   
    public function fight($enemy)
    {
        $damage = $this->force;
    
        if ($enemy instanceof Player) {
            $enemy->health -= $damage;
            
            if ($enemy->health <= 0) {
                echo "Le joueur a vaincu l'ennemi!";
                return true;
            } else {
                echo "Le joueur attaque l'ennemi et lui inflige " . $damage . " dégâts!";
                echo "<br>";
                echo "Points de vie de l'ennemi restants: " . $enemy->health;
                return false;
            }
        } else {
            echo "Aucune cible sélectionnée!";
            return false;
        }
    }
    
  
}
