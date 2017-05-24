<?php

include_once("../config/Config.php");
/**
 * Database class
 * Defines Database connection
 */
 class Database{
    private static $instance = null;

    /**
     * return connection to Database
     * @return Mysqli Connection
     */
    public static function getInstance(){
        global $_CONFIG;
        if(self::$instance == null){
             self::$instance = new Mysqli(  $_CONFIG["DATABASECONFIG"]["SERVER"], 
                                            $_CONFIG["DATABASECONFIG"]["USERNAME"],
                                            $_CONFIG["DATABASECONFIG"]["PASSWORD"] , 
                                            $_CONFIG["DATABASECONFIG"]["DATABASE"]
                                         );
            if (self::$instance->connect_errno) {
                echo "Failed to connect to MySQL: (" . self::$instance->connect_errno . ") " . self::$instance->connect_error;
            }
        }
        return self::$instance;
    }
}


