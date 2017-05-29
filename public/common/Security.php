<?php

class Security{
    
    public static function getHash($password, $salt) {
        return hash("sha256", $password . $salt);
    }

    public static function getSalt(){
        $intermediateSalt = md5(uniqid(rand(), true));
        $salt = substr($intermediateSalt, 0, 6);
        return $salt;
    }
}