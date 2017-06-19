<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/Item.php'; 

class ItemService 
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
        $result = $db->query('select count(*) as count from items');
        $this->_count = $result->fetch_assoc()['count'];
        return $this->_count;
    }

    public function get($page_num = 1, $limit = 10, $name = ''){
        global $_CONFIG;
        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$this->_LIMIT}";
        $name = $db->escape_string($name);
	    $nameQuery = " item_name like '%{$name}%' ";

		if($result = $db->query("select * from items where {$nameQuery} order by item_id desc limit {$limitQuery}"))
		{
           
		    $i =0;
		    while($obj = $result->fetch_assoc()){
               $item = new Item();
               $item->setId($obj["item_id"]);
               $item->setName($obj["item_name"]);
               $item->setDescription($obj["description"]);
               $item->setPath( $_CONFIG["UPLOADS"].$obj["path"]);

               $list[$i] = $item;
               $i++;
		    }
	    }
		 return $list;
    }

    public function findAllByCategory($page_num = 1, $limit = 10, $name = '', $cat_id){
        global $_CONFIG;
        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$this->_LIMIT}";
        $name = $db->escape_string($name);
        $cat_id = $db->escape_string($cat_id);
	    $nameQuery = " item_name like '%{$name}%' and fk_category_id = {$cat_id} ";

		if($result = $db->query("select * from items where {$nameQuery} order by item_id desc limit {$limitQuery}"))
		{
           
		    $i =0;
		    while($obj = $result->fetch_assoc()){
               $item = new Item();
               $item->setId($obj["item_id"]);
               $item->setName($obj["item_name"]);
               $item->setDescription($obj["description"]);
               $item->setPath( $_CONFIG["UPLOADS"].$obj["path"]);

               $list[$i] = $item;
               $i++;
		    }
	    }
		 return $list;
    }
    public static function exist($item){
        
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM items WHERE item_name = ?")){
            @$statement->bind_param("s", $item->getName());
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
        $item = new item();
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM items WHERE item_id = ?")){
            @$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while($obj = $rows->fetch_assoc()){
                    $item->setId($obj["item_id"]);
                    $item->setName($obj["item_name"]);
                    $item->setDescription($obj["description"]);
                    $item->setPath( $_CONFIG["UPLOADS"].$obj["path"]);
		        }
	        }
	    }

        return $item;
	}

    public static function insert($item, $file, $id){
         global $_CONFIG;

        $temp = explode(".", $file["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        if (!@move_uploaded_file($file["tmp_name"], $_CONFIG["UPLOADS"].$newfilename)) {
            $result = false;
            die();
            return false;
        } 

        if( $statement = @Database::getInstance()->prepare("INSERT INTO items SET item_name = ?, description = ?, path=?, fk_category_id = ?")){
            @$statement->bind_param("sssi", $item->getName(),$item->getDescription(), $newfilename, $id);
            $statement->execute();
            return true;
        }

        return false;
	}

    public static function update($item, $file, $id){
         global $_CONFIG;
         $newfilename = "";
         if( strcmp($file["name"], "") != 0){
            $temp = explode(".", $file["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            if (!@move_uploaded_file($file["tmp_name"], $_CONFIG["UPLOADS"].$newfilename)) {
                $result = false;
                
                return false;
             } 
              if( $statement = @Database::getInstance()->prepare("UPDATE items SET item_name = ?, description = ?, path=?, fk_category_id = ? WHERE item_id = ?")){
                @$statement->bind_param("sssii", $item->getName(),$item->getDescription(), $newfilename, $id, $item->getId());
                $statement->execute();
                return true;
              }
         }else{
             if( $statement = @Database::getInstance()->prepare("UPDATE items SET item_name = ?, description = ?, fk_category_id = ? WHERE item_id = ?")){
                @$statement->bind_param("ssii", $item->getName(),$item->getDescription(), $id, $item->getId());
                $statement->execute();
                return true;
              }
         }
         unlink($_CONFIG["UPLOADS"].$newfilename);

        return false;
	}

    public static function delete($id){
        global $_CONFIG;
        $paths = [];
        $i = 0;

        Database::getInstance()->autocommit (false);
        if( $statement = @Database::getInstance()->prepare("SELECT path FROM items WHERE item_id = ?")){
            $statement->bind_param("i", $id);
            $statement->execute();

            if($rows = $statement->get_result()){
                while($row = $rows->fetch_assoc()){
                    $paths[$i] = $row["path"];
                    $i++;
                }
            }else{
                Database::getInstance()->rollback();
                return false;
            }

            if( $statement = @Database::getInstance()->prepare("DELETE FROM items WHERE item_id = ?")){
                $statement->bind_param("i", $id);
                $statement->execute();
                foreach($paths as $path){
                    unlink($_CONFIG["UPLOADS"].$path);
                }
                Database::getInstance()->commit();
                return true;
            }else{
                Database::getInstance()->rollback();
            }
        }else{
             Database::getInstance()->rollback();
        }
      
        return false;
	}
}
?>