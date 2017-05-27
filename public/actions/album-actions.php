<?php
    require('../classes/Album.php');
    require('../services/AlbumService.php');

    $album = new Album();

    if(isset($_GET["id"])){
        $album->setId($_GET["id"]);
    }
    
    if(isset($_GET["delete"]) && isset($_GET["id"])){
        if(!AlbumService::delete($album->getId())){
            header("location: ../views/album-management.php?error=9");
            exit;
        }
        header("location: ../views/album-management.php");
        exit;
    }
    
    $album->setName($_POST["name"]);
    $album->setDescription($_POST["description"]);

    if(strcmp($_POST['name'], "") == 0){
        header("location: ../views/album-management.php?error=1");
        exit;
    }

    if( $album->getId() == 0){
        $exist = AlbumService::exist($album);

        if($exist){
            header("location: ../views/album-management.php?error=2");
            exit;
        }

        if(!AlbumService::insert($album)){
            header("location: ../views/album-management.php?error=9");
            exit;
        }
    }else{
        if(!AlbumService::update($album)){
            header("location: ../views/album-management.php?error=9");
            exit;
        }
    }

    header("location: ../views/album-management.php");
    exit;

?>