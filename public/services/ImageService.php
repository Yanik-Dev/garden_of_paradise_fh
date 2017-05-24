<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/Image.php'; 
include_once("../config/Config.php");

class UserService 
{
    
	public static function insert($imagePaths = [], $albumId){
        try{
            Database::getInstance()->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Database::getInstance()->beginTransaction ();
            
            foreach($imagePaths as $path){
                if (move_uploaded_file($path["fileToUpload"]["tmp_name"], $_CONFIG["UPLOADS"])) {
                    
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