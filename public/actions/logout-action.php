<?php
session_start();
require_once('../services/UserService.php');

UserService::unsetUserSession();

 header("location: ../views/home.php");
 exit;