<?php

namespace Core\Service\Gameplay;

use Core\Helper\View;
use Core\Players\Player;
use Core\Players\Beast\BeastFactory;
use Core\Players\Hero\HeroFactory;

class GameplayService
{
    private $players = array();

    /** @var Player */
    private $attacker;

    /** @var  Player */
    private $defender;

    private $filters;

    private function findFirstAttackers()
    {
        usort($this->players, function($a, $b)
        {
            $name = strcmp($b->speed, $a->speed);
            if ($name === 0) {
                return $b->luck - $a->luck;
            }
            return $name;
        });

        $this->setAttackers();
        $this->setDefenders();
    }

    private function setAttackers()
    {
        $this->attacker = array_slice($this->players, 0, 1)[0];
    }

    private function setDefenders()
    {
        $this->defender = array_slice($this->players, 1)[0];
    }

    public function startFight()
    {
        $this->findFirstAttackers();

        echo '<pre>';

        for ($i = 1; $i <= 20; $i++) {

            View::add('<b>Round ' . $i . '</b><br>');
            View::add('<b>' . $this->attacker->getName() . '</b> attack <b>' . $this->defender->getName() . '</b><br>');

            View::add('<b>Attacker (' . $this->attacker->getName() . ')</b> status:');
            View::add('Health: ' . $this->attacker->getHealth() . '');
            View::add('Speed: ' . $this->attacker->getSpeed() . '');
            View::add('Strength: ' . $this->attacker->getStrength() . '');
            View::add('Defense: ' . $this->attacker->getDefense() . '');
            View::add('Luck: ' . $this->attacker->getLuck() . '');
            View::add('');

            View::add('<b>Defender (' . $this->defender->getName() . ')</b> status:');
            View::add('Health: ' . $this->defender->getHealth() . '');
            View::add('Speed: ' . $this->defender->getSpeed() . '');
            View::add('Strength: ' . $this->defender->getStrength() . '');
            View::add('Defense: ' . $this->defender->getDefense() . '');
            View::add('Luck: ' . $this->defender->getLuck() . '');
            View::add('');

            if ($this->defender->haveLuck()) {
                //echo '<b style="color:red">' . $this->defender->class . '</b> have luck<br>';
                View::add('<b style="color:red">' . $this->defender->getName() . ' have luck this round!</b>');
                View::add('<hr>');
                $this->switchPlayers();
                continue;
            }

            $this->attacks();

            if ($this->isGameOver()) {

                View::add('<div style="padding: 10; background-color:silver">');

                View::add('<b>' . $this->attacker->getName() . '</b> beat <b>' . $this->defender->getName() . '</b>');
                View::add('<b style="text-transform: uppercase">The winner is ' . $this->attacker->getName() . '</b>');


                View::add('<b>Attacker (' . $this->attacker->getName() . ')</b> status:');
                View::add('Health: ' . $this->attacker->getHealth() . '');
                View::add('Speed: ' . $this->attacker->getSpeed() . '');
                View::add('Strength: ' . $this->attacker->getStrength() . '');
                View::add('Defense: ' . $this->attacker->getDefense() . '');
                View::add('');

                View::add('<b>Defender (' . $this->defender->getName() . ')</b> status:');
                View::add('Health: ' . $this->defender->getHealth() . '');
                View::add('Speed: ' . $this->defender->getSpeed() . '');
                View::add('Strength: ' . $this->defender->getStrength() . '');
                View::add('Defense: ' . $this->defender->getDefense() . '');
                View::add('</div>');

                break;
            }

            $this->switchPlayers();

            View::add('<hr>');
        }

        View::output();
    }

    public function createHeroPlayer(array $player) {
        /** @var HeroFactory $hero */
        $hero = new HeroFactory();
        $this->players[] = $hero->create($player);
    }

    public function createBeastPlayer(array $player) {
        /** @var BeastPlayer $beast */
        $beast = new BeastFactory();
        $this->players[] = $beast->create($player);
    }

    public function attacks()
    {
        $this->setDamageFilter();

        View::add('<b>' . $this->attacker->getName() . '</b> damage: ' . $this->filters['damage']);

        $this->attacker->applyAttackSkills($this->filters);

        $this->defends();
    }

    public function defends()
    {
        $this->defender->applyDefendSkills($this->filters);

        $this->applyDamageFilter();
    }

    private function setDamageFilter()
    {
        $this->filters['damage'] = $this->attacker->getStrength() - $this->defender->getDefense();
    }

    private function applyDamageFilter()
    {
        if (isset($this->filters['damage'])) {
            $health = $this->defender->getHealth() - $this->filters['damage'];
            $this->defender->setHealth($health);
        }
    }

    private function isGameOver()
    {
        if ($this->defender->getHealth() <= 0) {
            return true;
        }
        return false;
    }

    private function switchPlayers()
    {
        // Switch attacker with defender
        $tmpAttacher = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $tmpAttacher;
    }

}