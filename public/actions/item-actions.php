<?php 
require_once('../services/ItemService.php');
require_once('../classes/Item.php');

$item = new Item();

    if(isset($_GET["id"])){
        $item->setId($_GET["id"]);
    }
    
    if(isset($_GET["delete"]) && isset($_GET["id"])){
        if(!itemService::delete($item->getId())){
        }
        header("location: ../views/item-management.php?cat_id=".$_POST["category"]);
        exit;
    }
    
    if(!strcmp($_FILES['file']['tmp_name'], "") ==0){
        if (!in_array( $_FILES['file']['type'], array ('image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png') )){
            header("location: ../views/item-management.php?id=".$_POST['category']."&error=5");
            exit;
        }
    }

    if(strcmp($_POST['name'], "") == 0){
        header("location: ../views/item-management.php?error=1&cat_id=".$_POST["category"]);
        exit;
    }

    if(strcmp($_POST['description'], "") == 0){
        header("location: ../views/item-management.php?error=3&cat_id=".$_POST["category"]);
        exit;
    }



    $item->setName($_POST['name']);
    $item->setDescription($_POST['description']);
    if( $item->getId() == 0){
        $exist = itemService::exist($item);

        if($exist){
            header("location: ../views/item-management.php?error=2&cat_id=".$_POST["category"]);
            exit;
        }

        if(!itemService::insert($item, $_FILES['file'], $_POST["category"])){
            header("location: ../views/item-management.php?error=9&cat_id=".$_POST["category"]);
            exit;
        }
    }else{
        if(!itemService::update($item, $_FILES['file'], $_POST["category"])){
            header("location: ../views/item-management.php?error=9&cat_id=".$_POST["category"]);
            exit;
        }
    }
     header("location: ../views/item-management.php?cat_id=".$_POST["category"]);
        exit;