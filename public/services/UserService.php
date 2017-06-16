<?php 
require_once '../common/Databaseservice.php'; 
require_once '../classes/User.php'; 
	 
class UserService 
{
    public static function getUserSession(){
        return $_SESSION["user"];
    }

	public static function isLogin(){
        return isset($_SESSION["user"]);
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
		$username = $user->getUsername();
		if( $statement = @Database::getInstance()->prepare("select * from fh_users where username = ?")){
			$statement->bind_param("s", $username);
			$statement->execute();
		
			if($rows = $statement->get_result()){
				while($row = $rows->fetch_assoc()){
                   $result->setUsername($row["username"]);
                   $result->setSalt($row["salt"]);
                   $result->setPassword($row["password"]);
				}
			}
		}
        return $result;
	} 

	public static function create($user){
        if( $statement = @Database::getInstance()->prepare("INSERT INTO fh_users SET username = ?, password = ?, salt=?")){
			@$statement->bind_param("sss", $user->getUsername(), $user->getPassword(), $user->getSalt());
		
			$statement->execute();

			if($rows = $statement->get_result()){
				return true;
			}
            return false;
		}
	}

    public static function update($user){
        if( $statement = @Database::getInstance()->prepare("UPDATE INTO fh_users SET password = ?, salt=? WHERE username=?")){
			@$statement->bind_param("sss", $user->getPassword(), $user->getSalt(), $user->getUsername());
			$statement->execute();

			if($rows = $statement->get_result()){
				return true;
			}
            return false;
		}
	}

    
	
}
?>