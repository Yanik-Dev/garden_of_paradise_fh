<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/Obituary.php'; 

class ObituaryService 
{
    private $_count;
    private $_LIMIT;

    public function __construct(){
        $this->_LIMIT = 10;
    }

    public function getNumberOfPages(){
        return ceil($this->_count /$this->_LIMIT);
    }
    
    public function getCount(){
        $db = Database::getInstance();
        $result = $db->query('select count(*) as count from obituaries');
        $this->_count = $result->fetch_assoc()['count'];
        return $this->_count;
    }

    public function getByLimit($page_num = 1, $limit = 10, $name = ''){
        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$this->_LIMIT}";
        $name = $db->escape_string($name);
	    $nameQuery = " name like '%{$name}%' ";

		if($result = $db->query("select * from obituaries where {$nameQuery} order by id desc limit {$limitQuery}"))
		{
           
		    $i =0;
		    while($obj = $result->fetch_assoc()){
               $result = new Obituray();
               $result->setId($obj["id"]);
               $result->setName($obj["name"]);
               $result->setDetails($obj["details"]);
               $result->setGender($obj["gender"]);
               $result->setPath($obj["path"]);
               $result->setPath($obj["date"]);
               
            $list[$i] = $result;
            $i++;
            }
	    }
		 return $list;
    }

    public static function exist($value){
        
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM obituaries WHERE name = ? and date = ?")){
            @$statement->bind_param("ss", $value->getName(), $value->getName());
            $statement->execute();
            if($rows = $statement->get_result()){
                while($row = $rows->fetch_assoc()){
                   return true;
                }
            }
        }

        return false;
	}

    public static function findOne($id){
        $result = new Obituray();
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM obituaries WHERE id = ?")){
            @$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while($obj = $rows->fetch_assoc()){
                    $result->setId($obj["id"]);
                    $result->setName($obj["name"]);
                    $result->setDetails($obj["details"]);
                    $result->setGender($obj["gender"]);
                    $result->setPath($obj["path"]);
                    $result->setPath($obj["date"]);
                }
	        }
	    }
        return $result;
	}

    public static function insert($obj, $file){
         global $_CONFIG;
         
        if (!@move_uploaded_file($file["tmp_name"], $_CONFIG["UPLOADS"].$file["name"])) {
            $result = false;
            return false;
        } 
        if( $statement = @Database::getInstance()->prepare("INSERT INTO obituaries SET name = ?, details = ?, gender =?, date=?, path =?")){
            @$statement->bind_param("sssss", $obj->getName(),$obj->getDetails(), $obj->getGender(), $obj->getDate(), $file["name"]);
            $statement->execute();
            return true;
        }

        return false;
	}

    public static function update($obj){
        
        if( $statement = @Database::getInstance()->prepare("INSERT INTO obituaries SET name = ?, details = ?, gender =?, date=?, path =? where id = ?")){
            @$statement->bind_param("sssssi", $obj->getName(),$obj->getDetails(), $obj->getGender(), $obj->getDate(), $obj->getPath(),$obj->getId());
            $statement->execute();
            return true;
        }

        return false;
	}

    public static function delete($id){
        global $_CONFIG;
        $paths = [];
        $i = 0;

        Database::getInstance()->autocommit (false);
        if( $statement = @Database::getInstance()->prepare("SELECT path FROM obituaries WHERE id = ?")){
            $statement->bind_param("i", $id);
            $statement->execute();

            if($rows = $statement->get_result()){
                while($row = $rows->fetch_assoc()){
                    $path[i] = $row["path"];
                    $i++;
                }
            }else{
                Database::getInstance()->rollback();
                return false;
            }

            if( $statement = @Database::getInstance()->prepare("DELETE  FROM obituaries WHERE id = ?")){
                $statement->bind_param("i", $id);
                $statement->execute();
           
                    foreach($paths as $path){
                      unlink($_CONFIG["UPLOADS"].$path);
                    }
                     Database::getInstance()->commit();
                    return true;
            }
        }else{
             Database::getInstance()->rollback();
        }
      
        return false;
	}
}
?>