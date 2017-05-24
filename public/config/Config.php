<?php

/**
 * Project Configurations
 * Contains all the configurations for external services
 * such as database, uploads folder, etc.
 *
 * USAGE: 
 *  include in your php template or service
 *  then access the associative arrays by.
 *  $_CONFIG["DATABASE"]["SERVER"] to get server name
 */

global $_CONFIG;

$_CONFIG = [
        "DATABASECONFIG" => [
            "SERVER" =>"127.0.0.1",
            "USERNAME" => "root",
            "PASSWORD" => "",
            "DATABASE" => "gardenfh_db"
        ],
        "UPLOADS"=> "",
];

