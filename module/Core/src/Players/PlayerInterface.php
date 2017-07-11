<?php

namespace Core\Players;

interface PlayerInterface
{
    public function getHealth();

    public function setHealth($val);

    public function getSpeed();
    public function setSpeed($val);

    public function getLuck();
    public function setLuck($val);

    public function getStrength();
    public function setStrength($val);

    public function getDefense();
    public function setDefense($val);

    public function create(array $player);

    public function applyAttackSkills(&$filters);

    public function applyDefendSkills(&$filters);
}