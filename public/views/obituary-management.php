<?php
 session_start();
 $page = 3;
 require('../services/ObituaryService.php');
 $title = "Obituary Management";
 require_once('admin-sidebar.php');
 
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
<div class="container obituary-management" style="padding-right: 50px;">
    <h3> Obituary Form </h3>
   <a href="./obituary-grid.php" class="btn btn-danger" style="margin-bottom: 20px;">Back to grid</a>
                <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <?php if($_GET['error'] == 2): ?>
                            Person already exist
                        <?php endif; ?>
                        <?php if($_GET['error'] == 5): ?>
                           Images must be JPEG or PNG
                        <?php endif; ?>
                        <?php if($_GET['error'] == 1): ?>
                           You must supply a album name
                        <?php endif; ?>
                        <?php if($_GET['error'] == 3): ?>
                           You must supply a date
                        <?php endif; ?>
                        <?php if($_GET['error'] == 4): ?>
                           You must supply details about the person
                        <?php endif; ?>
                        <?php if($_GET['error'] == 9): ?>
                           Server error. contact admin.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
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
                    <button type="submit" class="cust-btn"><?= (isset($obituary))?'Save Changes':'Insert'?></button>
                </form>
                <br />
                <br />
                <br />
        </div>
        </div>

</div>

<?php require_once('admin-footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>