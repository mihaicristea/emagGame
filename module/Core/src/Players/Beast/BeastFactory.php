<?php

namespace Core\Players\Beast;

use Core\Players\Beast\BeastPlayer;

class BeastFactory
{
    public function create(array $player)
    {
        /** @var BeastPlayer $beast */
        $beast = new BeastPlayer();
        $beast->create($player);

        return $beast;
    }
}