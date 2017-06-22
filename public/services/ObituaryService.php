<?php 

require_once '../classes/Obituary.php'; 
require_once '../common/DatabaseService.php'; 

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
         global $_CONFIG;
        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$limit}";
        $name = $db->escape_string($name);
	    $nameQuery = " name like '%{$name}%' ";

		if($results = $db->query("select * from obituaries where {$nameQuery} order by id desc limit {$limitQuery}"))
		{
          
		    $i =0;
		    while($obj = $results->fetch_assoc()){
               $result = new Obituary();
               $result->setId($obj["id"]);
               $result->setName($obj["name"]);
               $result->setDetails($obj["details"]);
               if(isset($obj["photo"])){
                      $result->setPath($_CONFIG["UPLOADS"].$obj["photo"]);
               }
               $result->setDate($obj["date"]);
               
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
         global $_CONFIG;
        $result = null;
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM obituaries WHERE id = ?")){
            @$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while($obj = $rows->fetch_assoc()){
                    $result = new Obituary();
                    $result->setId($obj["id"]);
                    $result->setName($obj["name"]);
                    $result->setDetails($obj["details"]);
                    if(isset($obj["photo"])){
                      $result->setPath($_CONFIG["UPLOADS"].$obj["photo"]);
                    }
                    $result->setDate($obj["date"]);
                }
	        }
	    }
        return $result;
	}

    public static function insert($obj, $file){
         global $_CONFIG;
         $newfilename = "";
         if( strcmp($file["name"], "") != 0){
            $temp = explode(".", $file["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            if (!@move_uploaded_file($file["tmp_name"], $_CONFIG["UPLOADS"].$newfilename)) {
                $result = false;
                
                return false;
            } 
            $str ="INSERT INTO obituaries SET name = ?, details = ?,  date=?, photo =?";
            if( $statement = @Database::getInstance()->prepare($str)){
                @$statement->bind_param("ssss", $obj->getName(),$obj->getDetails(), $obj->getDate(), $file["name"]);
                $statement->execute();
                return true;
            }
         }else{
             $str = "INSERT INTO obituaries SET name = ?, details = ?,  date=?";
             if( $statement = @Database::getInstance()->prepare($str)){
                @$statement->bind_param("sss", $obj->getName(),$obj->getDetails(), $obj->getDate());
                $statement->execute();
                return true;
            }
         }
        unlink($_CONFIG["UPLOADS"].$newfilename);

        return false;
	}

    public static function update($obj, $file){
        
         global $_CONFIG;
         
         if( strcmp($file["name"], "") != 0){
            $temp = explode(".", $file["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            if (!@move_uploaded_file($file["tmp_name"], $_CONFIG["UPLOADS"].$newfilename)) {
                $result = false;
                
                return false;
            } 
            $str ="UPDATE obituaries SET name = ?, details = ?,  date=?, photo =? where id = ?";
            if( $statement = @Database::getInstance()->prepare($str)){
                @$statement->bind_param("ssssi", $obj->getName(),$obj->getDetails(), $obj->getDate(), $file["name"], $obj->getId());
                if($statement->execute()){
                    return true;
                }
            }
         }else{
             $str = "UPDATE obituaries SET name = ?, details = ?,  date=? where id = ?";
             if( $statement = @Database::getInstance()->prepare($str)){
                @$statement->bind_param("sssi", $obj->getName(),$obj->getDetails(), $obj->getDate(),$obj->getId());
                if($statement->execute()){
                    return true;
                }
            }
         }
        return false;
	}

    public static function delete($id){
        global $_CONFIG;
        $paths = [];
        $i = 0;

        Database::getInstance()->autocommit (false);
        if( $statement = @Database::getInstance()->prepare("SELECT photo FROM obituaries WHERE id = ?")){
            $statement->bind_param("i", $id);
            $statement->execute();

            if($rows = $statement->get_result()){
                while($row = $rows->fetch_assoc()){
                    $path[i] = $row["photo"];
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