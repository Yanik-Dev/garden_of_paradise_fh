<?php
session_start();
require('../services/UserService.php');
require('../common/Security.php');

$user = new User();
$user->setUsername($_POST["username"]);
$user->setPassword($_POST["password"]);

$user = UserService::login($user);

if($user->getUsername() != null){
    $hash = Security::getHash($_POST["password"], $user->getSalt());
    if(strcmp($user->getPassword(), $hash) == 0){
        UserService::setUserSession($user);
        header("location: ../views/album-management.php");
        exit;
    }
}

header("location: ../views/admin-login.php?error=1");
exit;
