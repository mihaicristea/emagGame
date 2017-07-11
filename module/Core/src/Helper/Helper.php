<?php

namespace Core\Helper;

use Core\ConfigDI\ConfigDI;

class Helper
{
    public static function getConfig()
    {
        $config = ConfigDI::getInstance();
        return $config->getConfig();
    }

    /**
     * @param int $chance
     * @return bool
     */
    public static function getLuck($chance)
    {
        if (rand(1, 100) <= $chance) {
            return true;
        }
        return false;
    }

}

