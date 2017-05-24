<?php

class Album{
    private $_id = 0;
    private $_name = 0;
    private $_images = [];

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

    public function getImages(){
        return $this->_images;
    }

    public function setImages($images = []){
        $this->_images = $images;
    }
}
?>