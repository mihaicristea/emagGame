<?php

namespace Core\Players\Hero;

use Core\Players\Player;

class HeroPlayer extends Player
{
    public function __construct()
    {
        $this->setName('Hero');
    }
}