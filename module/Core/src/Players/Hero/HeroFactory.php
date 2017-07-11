<?php

namespace Core\Players\Hero;

use Core\Players\Hero\HeroPlayer;

class HeroFactory
{
    public function create(array $player)
    {
        /** @var HeroPlayer $hero */
        $hero = new HeroPlayer();
        $hero->create($player);

        return $hero;
    }
}