<?php
class Obituary{
    private $_id;
    private $_path;
    private $_name;
    private $_date;
    private $_details;
    private $_gender;

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

    public function getGender(){
        return $this->_gender;
    }

    public function setGender($gender){
        $this->_gender = $gender;
    }
    
    public function getPath(){
        return $this->_path;
    }

    public function setPath($path){
        $this->_path = $path;
    }
    public function getDetails(){
        return $this->_details;
    }

    public function setDetails($details){
        $this->_details = $details;
    }

    public function getDate(){
        return $this->_date;
    }

    public function setDate($date){
        $this->_date = $date;
    }

    
}