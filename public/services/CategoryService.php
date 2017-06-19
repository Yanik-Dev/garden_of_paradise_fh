<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/Category.php'; 
require_once '../classes/Item.php'; 
require_once '../config/Config.php'; 

class CategoryService 
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
        $result = $db->query('select count(*) as count from categories');
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
	    $nameQuery = " category_name like '%{$name}%' ";

		if($result = $db->query("select * from categories where {$nameQuery} order by category_id desc limit {$limitQuery}"))
		{
           
		    $i =0;
		    while($obj = $result->fetch_assoc()){
               $category = new Category();
               $category->setId($obj["category_id"]);
               $category->setName($obj["category_name"]);

                $items = [];
                $id = $obj["category_id"];
                if($result2 = @Database::getInstance()->query("select * from items where fk_category_id = {$id}"))
                {
                    $x = 0;
                    while($row = $result2->fetch_assoc()){
                        $item = new Item();
                        $item->setId($row["item_id"]);
                        $item->setName($row["item_name"]);
                        $item->setDescription($row["description"]);
                        $item->setPath( $_CONFIG["UPLOADS"].$row["path"]);
                        $items[$x] = $item;
                        $x++;
                    }
                    $category->setItems($items);
                }
               $list[$i] = $category;
               $i++;
		    }
	    }
		 return $list;
    }

    public static function exist($category){
        
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM categories WHERE category_name = ?")){
            @$statement->bind_param("s", $category->getName());
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
        $category = new Category();
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM categories WHERE category_id = ?")){
            @$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while($obj = $rows->fetch_assoc()){
                    $category->setId($obj["category_id"]);
                    $category->setName($obj["category_name"]);

                     $items = [];
                    $id = $obj["category_id"];
                    if($result2 = @Database::getInstance()->query("select * from items where fk_category_id = {$id}"))
                    {
                        $x = 0;
                        while($row = $result2->fetch_assoc()){
                            $item = new Item();
                            $item->setId($row["item_id"]);
                            $item->setName($row["item_name"]);
                            $item->setDescription($row["description"]);
                            $item->setPath( $_CONFIG["UPLOADS"].$row["path"]);
                            $items[$x] = $item;
                            $x++;
                        }
                        $category->setItems($items);
                    }
                }
	        }
	    }

        return $category;
	}

    public static function insert($category){
        
        if( $statement = @Database::getInstance()->prepare("INSERT INTO categories SET category_name = ?")){
            @$statement->bind_param("s", $category->getName());
            $statement->execute();
            return true;
        }

        return false;
	}

    public static function update($category){
        
        if( $statement = @Database::getInstance()->prepare("UPDATE categories SET category_name = ? WHERE category_id=?")){
            @$statement->bind_param("si", $category->getName(), $category->getId());

            if (!$statement->execute()) {
                echo "Execute failed: (" . $statement->errno . ") " . $statement->error;
                die();
            }
            return true;
        }

        return false;
	}

    public static function delete($id){
        global $_CONFIG;
        $paths = [];
        $i = 0;

        Database::getInstance()->autocommit (false);
        if( $statement = @Database::getInstance()->prepare("SELECT path FROM items WHERE fk_category_id = ?")){
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

            if( $statement = @Database::getInstance()->prepare("DELETE FROM categories WHERE category_id = ?")){
                $statement->bind_param("i", $id);
                
                if (!$statement->execute()) {
                    echo "Execute failed: (" . $statement->errno . ") " . $statement->error;
                    return false;
                }
                Database::getInstance()->commit();
                foreach($paths as $path){
                      unlink($_CONFIG["UPLOADS"].$path);
                }
                return true;
            }else{
                Database::getInstance()->rollback();
            }
        } 
        return false;
    }

}
?>