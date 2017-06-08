<?php

class Testimony{
    private $_id = 0;
    private $_name = "";
    private $_comment="";

    public function getId(){
        return $this->_id;
    }

    public function setId($id){
        $this->_id=$id;
    }

    public function getName(){
        return $this->_name;
    }

    public function setName($name){
        $this->_name = $name;
    }
    
    public function getComment(){
        return $this->_comment;
    }

    public function setComment($comment){
        $this->_comment = $comment;
    }
}