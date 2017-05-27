<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/Image.php'; 
include_once("../config/Config.php");

class UserService 
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
        $result = $db->query('select count(*) as count from images');
        $this->_count = $result->fetch_assoc()['count'];
        return $this->_count;
    }

    public function getImagesbyLimit($page_num = 1, $limit = 10, $name = ''){

        $db = Database::getInstance();
        $this->_LIMIT = $limit;         
        $this->getCount();
		$start = $this->_LIMIT * ($page_num-1);
	    $list = [];
	    $limitQuery = "{$start},{$this->_LIMIT}";
	    $nameQuery = " name like '%{$name}' ";

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
    /*
                

            Multiple files can be selected and then uploaded using the
            <input type='file' name='file[]' multiple>
            The sample php script that does the uploading:

            <html>
            <title>Upload</title>
            <?php
                session_start();
                $target=$_POST['directory'];
                    if($target[strlen($target)-1]!='/')
                            $target=$target.'/';
                        $count=0;
                        foreach ($_FILES['file']['name'] as $filename) 
                        {
                            $temp=$target;
                            $tmp=$_FILES['file']['tmp_name'][$count];
                            $count=$count + 1;
                            $temp=$temp.basename($filename);
                            move_uploaded_file($tmp,$temp);
                            $temp='';
                            $tmp='';
                        }
                header("location:../../views/upload.php");
            ?>
    */
    public static function insert($imagePaths = [], $albumId){
        try{
            Database::getInstance()->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Database::getInstance()->beginTransaction ();
            
            foreach($imagePaths as $path){
                if (move_uploaded_file($path["file"]["tmp_name"], $_CONFIG["UPLOADS"])) {
                    
                } else {
                     Database::getInstance()->rollback ();
                }
                if( $statement = @Database::getInstance()->prepare("INSERT INTO users SET path = ?, fk_album_id = ?")){
                    $statement->bind_param("s", $path);
                    $statement->bind_param("i", $albumId);
                    $statement->execute();
                }
            }
            Database::getInstance()->commit();
            return true;
        }
        catch (Exception $e) { 
            if (Database::getInstance() != null) {
                Database::getInstance()->rollback();
                echo "Error:  " . $e; 
            }
        }
        foreach($imagePaths as $path){
            unlink($_CONFIG["UPLOADS"].$path['file']);
        }
        return false;
	}

    public static function delete($id){
        $path = "";
         if( $statement = @Database::getInstance()->prepare("SELECT path FROM gallery WHERE id = ?")){
			$statement->bind_param("s", $id);
            $statement->execute();

            $statement->bind_result($col1);
            while ($statement->fetch()) {
               $path = $col1;
            }
            $row = $statement->fetch_assoc();
            if( $statement = @Database::getInstance()->prepare("DELETE * FROM gallery WHERE id = ?")){
                $statement->bind_param("s", $id);
                $statement->execute();
                unlink($_CONFIG["UPLOADS"].$path);
                
                return true;
            }
         }
         return false;
	}

    
	
}
?>