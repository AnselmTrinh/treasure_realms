<?php
class Monster
{
    private $x;
    private $y;
    private $health;
    private $force;

    public function __construct($maxX, $maxY)
    {
        $this->x = rand(0, $maxX - 1);
        $this->y = rand(0, $maxY - 1);
  
        $this->health=rand(25,100);
        $this->force=rand(25,100);
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
    public function getmonsterX()
    {
        return $this->x;
    }

    public function getmonsterY()
    {
        return $this->y;
    }
}
