<?php

class Image{
    private $_id = 0;
    private $_path = 0;

    public function getId(){
        return $this->_id;
    }

    public function setId($id){
        $this->_id=$id;
    }

    public function getPath(){
        return $this->_path;
    }

    public function setPath($path){
        $this->_path = $path;
    }
}
?>