<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/User.php'; 
	 
class UserService 
{
    public static function getUserSession(){
        return $_SESSION["user"];
    }

    public static function setUserSession($user){
        return $_SESSION["user"] =$user;
    }
    
    public static function unsetUserSession(){
        unset($_SESSION["user"]);
    }

	public static function login($user)
	{
        $result = new User();
		if( $statement = @Database::getInstance()->prepare("select * from users where username = ? and password = ?")){
			$statement->bind_param("s", $user->getUsername());
			$statement->bind_param("s", $user->getPassword());
			$statement->execute();

			if($rows = $statement->get_result()){
				while($row = $rows->fetch_assoc()){
			       var_dump($row["username"]);
                   $result->setUsername($row["username"]);
				}
			}
		}
        return $result;
	} 

	public static function create($user){
        if( $statement = @Database::getInstance()->prepare("INSERT INTO users SET username = ?, password = ?, salt=?")){
			$statement->bind_param("s", $user->getUsername());
			$statement->bind_param("s", $user->getPassword());
			$statement->bind_param("s", $user->getSalt());
			$statement->execute();

			if($rows = $statement->get_result()){
				return true;
			}
            return false;
		}
	}

    public static function update($user){
        if( $statement = @Database::getInstance()->prepare("INSERT INTO users SET password = ?, salt=?")){
			$statement->bind_param("s", $user->getUsername());
			$statement->bind_param("s", $user->getPassword());
			$statement->bind_param("s", $user->getSalt());
			$statement->execute();

			if($rows = $statement->get_result()){
				return true;
			}
            return false;
		}
	}

    
	
}
?>