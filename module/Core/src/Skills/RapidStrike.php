<?php

namespace Core\Skills;

use Core\Helper\Helper;
use Core\Skills\SkillInterface;

class RapidStrike implements SkillInterface
{
    private $chance = 100;
    private $filters;

    public function __construct(&$filters)
    {
        $this->filters = &$filters;
        $this->applySkill();
    }

    public function applySkill()
    {
        if (Helper::getLuck($this->chance)) {
            $this->filters['damage'] *= 2;
        }
    }
}