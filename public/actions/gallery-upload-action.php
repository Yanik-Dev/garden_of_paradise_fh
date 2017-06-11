<?php
require('../services/ImageService.php');

$i=count($_FILES['files']['tmp_name']);


foreach($_FILES['files']['type'] as $type){
    if (!in_array( $type, array ('image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png') )){
        header("location: ../views/gallery-management.php?id=".$_POST['album']."&error=1");
        exit;
    }
}
if(strcmp($_FILES['files']['tmp_name'][0], "") ==0){
     header("location: ../views/gallery-management.php?id=".$_POST['album']."&error=0");
     exit;
}
if($i > 20){
     header("location: ../views/gallery-management.php?id=".$_POST['album']."&error=20");
     exit;
}


if(!ImageService::insert($_FILES['files'], $_POST['album'])){
    header("location: ../views/gallery-management.php?id=".$_POST['album']."&error=9");
     exit;
}
header("location: ../views/gallery-management.php?id=".$_POST['album']);
     exit;