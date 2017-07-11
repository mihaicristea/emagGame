<?php

namespace Core\Players;

use Core\Helper\Helper;
use Core\Helper\View;
use Core\Players\PlayerInterface;

class Player implements PlayerInterface
{
    protected $name;
    protected $health;
    protected $strength;
    protected $defense;
    public $speed;
    public $luck;

    private $class;

    public function getName()
    {
        return $this->name;
    }

    public function setName($val)
    {
        $this->name = $val;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($val)
    {
        $this->health = $val;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setSpeed($val)
    {
        $this->speed = $val;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setLuck($val)
    {
        $this->luck = $val;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setStrength($val)
    {
        $this->strength = $val;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function setDefense($val)
    {
        $this->defense = $val;
    }

    public function create(array $player)
    {
        if (isset($player['name'])) {
            $this->setName($player['name']);
        }

        if (isset($player['health'])) {
            $this->setHealth($player['health']);
        }

        if (isset($player['speed'])) {
            $this->setSpeed($player['speed']);
        }

        if (isset($player['luck'])) {
            $this->setLuck($player['luck']);
        }

        if (isset($player['strength'])) {
            $this->setStrength($player['strength']);
        }

        if (isset($player['defense'])) {
            $this->setDefense($player['defense']);
        }

        $this->class = get_class($this);
    }

    public final function toArray()
    {
        return get_object_vars($this);
    }

    public function applyAttackSkills(&$filters)
    {
        // apply attack skills
        $cfg = Helper::getConfig();
        foreach ($cfg['skills']['attack'] as $key => $attackSkill) {
            if (in_array($this->class, $attackSkill['players'])) {
                View::add('<b style="color:green">' . $this->name . ' use ' . $key . ' skill' . '</b>');
                new $attackSkill['class']($filters);
                View::add('<b>' . $this->name . '</b> damage: ' . $filters['damage']);
            }
        }
    }

    public function applyDefendSkills(&$filters)
    {
        // apply defend skills
        $cfg = Helper::getConfig();
        foreach ($cfg['skills']['defend'] as $key => $attackSkill) {
            if (in_array($this->class, $attackSkill['players'])) {
                View::add('<b style="color:green">' . $this->name . ' use ' . $key . ' skill' . '</b>');
                new $attackSkill['class']($filters);
                View::add('<b>' . $this->name . '</b> damage: ' . $filters['damage']);
            }
        }
    }

    public function haveLuck()
    {
        if (Helper::getLuck($this->luck)) {
            return true;
        }
        return false;
    }

}