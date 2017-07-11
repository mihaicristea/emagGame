<?php

namespace Core\ConfigDI;

class ConfigDI
{
    private $_config;
    private static $_instance; //The single instance

    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if (! self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct()
    {
        try {
            $cfg = require __DIR__ . '/../../config/general.php';
            $this->_config = $cfg;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {}
    
    public function getConfig()
    {
        return $this->_config;
    }
}