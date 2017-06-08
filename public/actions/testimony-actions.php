<?php
    require('../classes/Testimony.php');
    require('../services/testimonyService.php');

    $testimony = new Testimony();

    if(isset($_GET["id"])){
        $testimony->setId($_GET["id"]);
    }
    
    if(isset($_GET["delete"]) && isset($_GET["id"])){
        if(!testimonyService::delete($testimony->getId())){
            header("location: ../views/testimony-management.php?error=9");
            exit;
        }
        header("location: ../views/testimony-management.php");
        exit;
    }
    


    if(strcmp($_POST['name'], "") == 0){
        header("location: ../views/testimony-management.php?error=1");
        exit;
    }

    if(strcmp($_POST['comment'], "") == 0){
        header("location: ../views/testimony-management.php?error=3");
        exit;
    }

    $testimony->setName($_POST["name"]);
    $testimony->setComment($_POST["comment"]);
    
    if( $testimony->getId() == 0){
        $exist = testimonyService::exist($testimony);

        if($exist){
            header("location: ../views/testimony-management.php?error=2");
            exit;
        }

        if(!testimonyService::insert($testimony)){
            header("location: ../views/testimony-management.php?error=9");
            exit;
        }
    }else{
        if(!testimonyService::update($testimony)){
            header("location: ../views/testimony-management.php?error=9");
            exit;
        }
    }

    header("location: ../views/testimony-management.php");
    exit;

?>