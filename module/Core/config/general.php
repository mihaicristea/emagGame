<?php

return array(
    'skills' => array(
        'defend' => array(
            'magicShield' => array(
                'class' => \Core\Skills\MagicShield::class,
                'players' => array(
                    \Core\Players\Hero\HeroPlayer::class,
                ),
            ),
        ),
        'attack' => array(
            'rapidStrike' => array(
                'class' => \Core\Skills\RapidStrike::class,
                'players' => array(
                    Core\Players\Hero\HeroPlayer::class,
                ),
            )
        ),
    ),
);