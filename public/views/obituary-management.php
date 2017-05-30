<?php
 session_start();
 require('../services/ObituaryService.php');
 $title = "Obituary Management";
 require_once('header.php');
?> 

<?php
    $obituaryService = new ObituaryService();
    $page_num = 1;
    $obituary = null;
    if(isset($_GET["id"])){
        $obituary = ObituaryService::findOne($_GET["id"]);
        if($obituary->getId() < 1){
            header("location: ./obituary-management.php");
            exit;
        }
    }
    if(isset($_GET['page_num'])){
         if($_GET['page_num'] > 1 && $_GET['page_num'] > $obituaryService->getCount()){
             $page_num = 1;
         }
         else if($_GET['page_num']>1){
            $page_num = $_GET['page_num'];
         }
    }
    if(isset($_GET["q"])){
       $obituaryList = $obituaryService->getByLimit($page_num, 10, $_GET["q"]);
    }else{
       $obituaryList = $obituaryService->getByLimit($page_num, 10);
    }
    $numberOfPages = $obituaryService->getNumberOfPages();

?>
<div class="container obituary-management">
    
                <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <?php 
                  if(isset($_GET["error"])){
                      if($_GET["error"] == 1){
                        echo"<p class='error'>*You must supply a obituary name</p>";
                      }
                      if($_GET["error"] == 2){
                        echo"<p class='error'>*Person already exist</p>";
                      }
                      if($_GET["error"] == 9){
                        echo"<p class='error'>*Server error. contact admin.</p>";
                      }
                  }
                ?>
                <form action="<?= (isset($obituary))?'../actions/obituary-actions.php?id='.$obituary->getId():'../actions/obituary-actions.php'?>" method="post">
                    <input type="text" value="<?=(isset($obituary))?$obituary->getName():''?>" class="form-control" name="name" placeholder="Name">
                    <input type="date" value="<?=(isset($obituary))?$obituary->getDate():''?>" class="form-control" name="name" >
                    <select>
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea id="details" type="text" name="description" class="ckeditor" id="detail" required><?=(isset($obituary))?$obituary->getDetails():''?></textarea>
                    </div>
                    <button type="submit" class=""><?= (isset($obituary))?'Save Changes':'Create'?></button>
                </form>

        </div>
        </div>

</div>

<?php require_once('footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>