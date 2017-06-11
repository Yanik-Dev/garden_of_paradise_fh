<?php

class Category{
    private $_id = 0;
    private $_name = "";
    private $_items = [];
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
    public function getItems(){
        return $this->_items;
    }

    public function setItems($items){
        $this->_items = $items;
    }


    
  
}
?>