<?php

namespace Core\Helper;


class View
{
    public static $output = array();

    public static function add($message) {
        self::$output [] = $message;
    }

    public static function output()
    {
        echo implode("\n", self::$output);
    }
}