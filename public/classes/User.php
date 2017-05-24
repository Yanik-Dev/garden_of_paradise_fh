<?php

class User{
    private $_username;
    private $_password;
    private $_salt;

    public function getUsername(){
        return $this->_username;
    }

    public function setUsername($username){
        $this->_username=$username;
    }

    public function getPassword(){
        return $this->_password;
    }

    public function setPassword($password){
        $this->_password = $password;
    }
    
    public function getSalt(){
        return $this->_salt;
    }

    public function setSalt($salt){
        $this->_salt = $salt;
    }

}
?>