<?php 
require_once dirname(__FILE__).'/../common/DatabaseService.php'; 
require_once dirname(__FILE__).'/../classes/Testimony.php'; 
	 
class TestimonyService 
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
        $result = $db->query('select count(*) as count from testimonies');
        $this->_count = $result->fetch_assoc()['count'];
        return $this->_count;
    }

	 public function get($page_num = 1, $limit = 10, $name = ''){
        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$this->_LIMIT}";
        $name = $db->escape_string($name);
	    $nameQuery = " name like '%{$name}%' ";

		if($result = $db->query("select * from testimonies where {$nameQuery} order by id desc limit {$limitQuery}"))
		{
           
		    $i =0;
		    while($obj = $result->fetch_assoc()){
               $testimony = new Testimony();
               $testimony->setId($obj["id"]);
               $testimony->setName($obj["name"]);
               $testimony->setComment($obj["comment"]);

               $list[$i] = $testimony;
               $i++;
		    }
	    }
		 return $list;
    }

     public static function findOne($id){
        $testimony = new Testimony();
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM testimonies WHERE id = ?")){
            @$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while($obj = $rows->fetch_assoc()){
                    $testimony->setId($obj["id"]);
                    $testimony->setName($obj["name"]);
                    $testimony->setComment($obj["comment"]);
                }
	        }
	    }

        return $testimony;
	}
	public static function insert($testimony){
        if( $statement = @Database::getInstance()->prepare("INSERT INTO testimonies SET name = ?, comment = ?")){
			@$statement->bind_param("ss", $testimony->getName(), $testimony->getComment());
			$statement->execute();

			if($statement->execute()){
				return true;
			}
            return false;
		}
	}

    public static function update($testimony){
        if( $statement = @Database::getInstance()->prepare("UPDATE testimonies SET name = ?, comment=? WHERE id = ?")){
			@$statement->bind_param("ssi", $testimony->getName(), $testimony->getComment(),$testimony->getId());
			$statement->execute();

			if($statement->execute()){
				return true;
			}
            return false;
		}
	}

    public static function delete($id){
        
		if( $statement = @Database::getInstance()->prepare("DELETE FROM testimonies WHERE id = ?")){
			$statement->bind_param("i", $id);
			$statement->execute();
			
			return true;
		}
         
         return false;
	}

    
    public static function exist($testimony){
        
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM testimonies WHERE name = ? AND comment = ?")){
            @$statement->bind_param("ss", $testimony->getName(),$testimony->getComment());
            $statement->execute();
            if($rows = $statement->get_result()){
                while($row = $rows->fetch_assoc()){
                   return true;
                }
            }
        }

        return false;
	}

}
?>