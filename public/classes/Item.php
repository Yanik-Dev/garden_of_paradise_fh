<?php

class Item{
    private $_id = 0;
    private $_name = "";
    private $_description="";
    private $_path;

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
    
    public function getDescription(){
        return $this->_description;
    }

    public function setDescription($description){
        $this->_description = $description;
    }
        public function getPath(){
        return $this->_path;
    }

    public function setPath($path){
        $this->_path = $path;
    }
  
}
?>