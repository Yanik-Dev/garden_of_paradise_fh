<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/Album.php'; 

class AlbumService 
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
        $result = $db->query('select count(*) as count from albums');
        $this->_count = $result->fetch_assoc()['count'];
        //$db->close();
        return $this->_count;
    }

    public function getAlbumbyLimit($page_num = 1, $limit = 10, $name = ''){
        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$this->_LIMIT}";
        $name = $db->escape_string($name);
	    $nameQuery = " name like '%{$name}%' ";

		if($result = $db->query("select * from albums where {$nameQuery} order by id desc limit {$limitQuery}"))
		{
           
		    $i =0;
		    while($obj = $result->fetch_assoc()){
               $album = new Album();
               $album->setId($obj["id"]);
               $album->setName($obj["name"]);
               $album->setDescription($obj["description"]);

               $images = [];
               $id = $obj["id"];
               if($result2 = $db->query("select * from images where fk_album_id = {$id}"))
		       {
                  $x = 0;
		          while($row = $result2->fetch_assoc()){
                     $image = new Image();
		             $image->setId($row["id"]);
		             $image->setPath($row["path"]);
                     $images[$x] = $image;
                  }
                  $album->setImages($images);
               }
               $list[$i] = $album;
               $i++;
		    }
	    }
		 return $list;
    }

    public static function exist($album){
        
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM albums WHERE name = ?")){
            @$statement->bind_param("s", $album->getName());
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
        $album = new Album();
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM albums WHERE id = ?")){
            @$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while($row = $rows->fetch_assoc()){
                   $album->setName($row["name"]);
                   $album->setDescription($row["description"]);
                   $album->setId($row["id"]);
                }
            }
        }

        return $album;
	}

    public static function insert($album){
        
        if( $statement = @Database::getInstance()->prepare("INSERT INTO albums SET name = ?, description = ?")){
            @$statement->bind_param("ss", $album->getName(),$album->getDescription());
            $statement->execute();
            return true;
        }

        return false;
	}

    public static function update($album){
        
        if( $statement = @Database::getInstance()->prepare("UPDATE albums SET name = ?, description = ? WHERE id=?")){
            @$statement->bind_param("ssi", $album->getName(), $album->getDescription(),$album->getId());

            if (!$statement->execute()) {
                echo "Execute failed: (" . $statement->errno . ") " . $statement->error;
                die();
            }
            return true;
        }

        return false;
	}

    public static function delete($id){
        $paths = [];
        $i = 0;

        Database::getInstance()->autocommit (false);
        if( $statement = @Database::getInstance()->prepare("SELECT path FROM images WHERE fk_album_id = ?")){
            $statement->bind_param("i", $id);
            $statement->execute();

        
            if($rows = $statement->get_result()){
                while($row = $rows->fetch_assoc()){
                    $path[i] = $row["path"];
                    $i++;
                }
            }else{
                Database::getInstance()->rollback();
            }

    
            if( $statement = @Database::getInstance()->prepare("DELETE  FROM images WHERE fk_album_id = ?")){
                $statement->bind_param("i", $id);
                $statement->execute();
                
                if( $statement = @Database::getInstance()->prepare("DELETE FROM albums WHERE id = ?")){
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
        }else{
             Database::getInstance()->rollback();
        }
      
        return false;
	}

    
	
}
?>