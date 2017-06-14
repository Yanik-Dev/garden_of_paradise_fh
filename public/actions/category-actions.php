<?php
    require('../classes/Category.php');
    require('../services/CategoryService.php');

    $category = new Category();

    if(isset($_GET["id"])){
        $category->setId($_GET["id"]);
    }
    
    if(isset($_GET["delete"]) && isset($_GET["id"])){
        if(!CategoryService::delete($category->getId())){
            header("location: ../views/category-management.php?error=9");
            exit;
        }
        header("location: ../views/category-management.php");
        exit;
    }
    
    $category->setName($_POST["name"]);

    if(strcmp($_POST['name'], "") == 0){
        header("location: ../views/category-management.php?error=1");
        exit;
    }

    if( $category->getId() == 0){
        $exist = CategoryService::exist($category);

        if($exist){
            header("location: ../views/category-management.php?error=2");
            exit;
        }

        $count = CategoryService::getCount();

        if($count == 10){
             header("location: ../views/category-management.php?error=10");
            exit;
        }

        if(!CategoryService::insert($category)){
            header("location: ../views/category-management.php?error=9");
            exit;
        }
    }else{
        if(!CategoryService::update($category)){
            header("location: ../views/category-management.php?error=9");
            exit;
        }
    }

    header("location: ../views/category-management.php");
    exit;

?>