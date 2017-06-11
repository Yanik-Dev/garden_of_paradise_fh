<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/Image.php'; 
include_once("../config/Config.php");

class ImageService 
{
    private $_count;
    private $_LIMIT;

    public function __construct(){
        $this->_LIMIT = 10;
    }

    public function getCount(){
        $db = Database::getInstance();
        $result = $db->query('select count(*) as count from images');
        $this->_count = $result->fetch_assoc()['count'];
        return $this->_count;
    }

    public function getImagesbyLimit($page_num = 1, $limit = 20, $id = 0){

        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$this->_LIMIT}";
	    $nameQuery = " fk_album_id = {$id} ";

		if($result = $db->query("select * from images where {$nameQuery} order by id desc limit {$limitQuery}"))
		{
		    $i =0;
		    while($obj = $result->fetch_assoc()){
		       $list[$i] = $obj;
		       $i++;
		    }
		   
	    }
		 return $list;
    }

    /*public static function findOne($id){
        $testimony = null;
        if( $statement = @Database::getInstance()->prepare("SELECT * FROM images WHERE id = ?")){
            @$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while($obj = $rows->fetch_assoc()){
                    $testimony = new Testimony();
                    $testimony->setId($obj["id"]);
                    $testimony->setName($obj["name"]);
                    $testimony->setDetails($obj["details"]);

                }
	        }
	    }
        return $testimony;
    }*/

    public static function insert($imagePaths = [], $albumId){
          global $_CONFIG;
          $i = 0;
          $result = true;
          $files = [];
          Database::getInstance()->autocommit (false);
            foreach($imagePaths["tmp_name"] as $path){
                $temp = explode(".", $imagePaths["name"][$i]);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                if (!@move_uploaded_file($path, $_CONFIG["UPLOADS"].$newfilename)) {
                    $result = false;
                    break;
                } 
                $files[0]= $newfilename;
                if( $statement = @Database::getInstance()->prepare("INSERT INTO images SET path = ?, fk_album_id = ?")){
                    $statement->bind_param("si", $newfilename, $albumId);
                    $statement->execute();
                    
                }else{
                    $result = false;
                    break;
                }
                $i++;
            }

            if($result){
                if(Database::getInstance()->commit()){      
                        
                    return true;
                }
            }
            foreach($files as $path){
                $i=0;
                if(@unlink($_CONFIG["UPLOADS"].$path)){
                    continue;
                }
                $i++;
            }

           Database::getInstance()->rollback();
        return false;
	}

    public static function delete($id){
        global $_CONFIG;
        $path = "";
         if( $statement = @Database::getInstance()->prepare("SELECT path FROM images WHERE id = ?")){
			$statement->bind_param("i", $id);
            $statement->execute();
            if($rows = $statement->get_result()){
                while ($row=$rows->fetch_assoc()) {
                $path = $row["path"];
                }
            }

            if( $statement = @Database::getInstance()->prepare("DELETE FROM images WHERE id = ?")){
                $statement->bind_param("i", $id);
                $statement->execute();
                @unlink($_CONFIG["UPLOADS"].$path);
                
                return true;
            }
         }
         return false;
	}

    
	
}
?>