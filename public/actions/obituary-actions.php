<?php 
require_once('../services/ObituaryService.php');
require_once('../classes/Obituary.php');

$obituary = new Obituary();




    if(isset($_GET["id"])){
        $obituary->setId($_GET["id"]);
    }
    
    if(isset($_GET["delete"]) && isset($_GET["id"])){
        if(!obituaryService::delete($obituary->getId())){
        }
        header("location: ../views/obituary-grid.php");
        exit;
    }
    
    if(!strcmp($_FILES['file']['tmp_name'], "") ==0){
        if (!in_array( $_FILES['file']['type'], array ('image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png') )){
            header("location: ../views/obituary-management.php?id=".$_POST['album']."&error=5");
            exit;
        }
    }

    if(strcmp($_POST['name'], "") == 0){
        header("location: ../views/obituary-management.php?error=1");
        exit;
    }

    if(strcmp($_POST['date'], "") == 0){
        header("location: ../views/obituary-management.php?error=3");
        exit;
    }

    if(strcmp($_POST['details'], "") == 0){
        header("location: ../views/obituary-management.php?error=4");
        exit;
    }


    $obituary->setName($_POST['name']);
    $obituary->setDate($_POST['date']);
    $obituary->setDetails($_POST['details']);
    if( $obituary->getId() == 0){
        $exist = obituaryService::exist($obituary);

        if($exist){
            header("location: ../views/obituary-management.php?error=2");
            exit;
        }

        if(!ObituaryService::insert($obituary, $_FILES['file'])){
            header("location: ../views/obituary-management.php?error=9");
            exit;
        }
    }else{
        if(!ObituaryService::update($obituary, $_FILES['file'])){
            header("location: ../views/obituary-management.php?error=9");
            exit;
        }
    }
     header("location: ../views/obituary-grid.php");
        exit;