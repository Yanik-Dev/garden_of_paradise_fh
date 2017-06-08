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
                      if($_GET["error"] == 3){
                        echo"<p class='error'>*You must supply a date</p>";
                      }
                      if($_GET["error"] == 4){
                        echo"<p class='error'>*You must supply details about the person</p>";
                      }
                      if($_GET["error"] == 2){
                        echo"<p class='error'>*Person already exist</p>";
                      }
                      if($_GET["error"] == 9){
                        echo"<p class='error'>*Server error. contact admin.</p>";
                      }
                  }
                ?>
                <form action="<?= (isset($obituary))?'../actions/obituary-actions.php?id='.$obituary->getId():'../actions/obituary-actions.php'?>" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="exampleInputFile">Photo</label>
                        <input type="file" name="file" id="exampleInputFile">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                      <input type="text" value="<?=(isset($obituary))?$obituary->getName():''?>" class="form-control" name="name" minlength="2" maxlength="90" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                      <input type="text" value="<?=(isset($obituary))?$obituary->getDate():''?>" class="form-control" name="date" placeholder="eg. July 12, 1880 - June 28, 1946" required>
                    </div>
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea id="details" type="text" name="details" class="ckeditor" required><?=(isset($obituary))?$obituary->getDetails():''?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success"><?= (isset($obituary))?'Save Changes':'Create'?></button>
                </form>
                <br />
                <br />
                <br />
        </div>
        </div>

</div>

<?php require_once('footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>