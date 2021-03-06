<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Service\Gameplay\GameplayService;

$hero = array(
    'health' => rand(70, 100),
    'strength'  => rand(70, 80),
    'defense' => rand(45, 55),
    'speed' => rand(40, 50),
    'luck' => rand(10, 30),
);

$beast = array(
    'health' => rand(60, 90),
    'strength'  => rand(60, 90),
    'defense' => rand(40, 60),
    'speed' => rand(40, 60),
    'luck' => rand(25, 40),
);

try {
    $gameplay = new GameplayService();

    $gameplay->createHeroPlayer($hero);
    $gameplay->createBeastPlayer($beast);

    $gameplay->startFight();

} catch (\Exception $e) {
    echo $e->getMessage();
}