<?php

require_once('../services/UserService.php');

if(!UserService::isLogin()){
     header("location: ./admin-login.php");
    exit;
}
?>
<!Doctype html>
<html>
    <head> 
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Garden Of Paradise - <?=$title?> </title>
      <link rel="stylesheet" type="Text/css" href="../assets/lib/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="Text/css" href="../assets/css/style.css">
      <link rel="stylesheet" type="Text/css" href="../assets/css/side-bar.css">
      <link rel="stylesheet" href="../assets/css/animate.css">
      <style>
  ul li.iactive{
      background-color: #F1AD48 !important;
  }
  .cust-btn{
    height: 50px !important;
    width: 100% !important; 
     background-color: #5da4ea;
    border: none !important;
    color: white !important;
    text-decoration: none !important;
    display: inline-block !important;
    font-size: 16px !important;
}
</style>
    </head>
    <body>

    <nav class="navbar navbar-default sidebar" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>      
            </div>
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?=($page==1)?'iactive':''?>"><a href="./album-management.php">Album<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-picture"></span></a></li>      
                <li class="<?=($page==2)?'iactive':''?>"><a href="./testimony-management.php">Testimonies<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-comment"></span></a></li>        
                <li class="<?=($page==3)?'iactive':''?>"><a href="./obituary-grid.php">Obituary<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
                <li class="<?=($page==4)?'iactive':''?>"><a href="./category-management.php">Items<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
                <li class="<?=($page==5)?'iactive':''?>"><a href="./change-password.php">Change Password<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-lock"></span></a></li>
                <li ><a href="../actions/logout-action.php">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a></li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="main" >