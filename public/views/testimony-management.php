<?php
 session_start();
 $title = "Testimonal Management";
 require_once('header.php');
 require_once('../services/TestimonyService.php');
?> 

<?php
    $testimonyService = new TestimonyService();
    $page_num = 1;
    $testimony = null;
    if(isset($_GET["id"])){
        $testimony = TestimonyService::findOne($_GET["id"]);
        if($testimony->getId() < 1){
            header("location: ./testimony-management.php");
            exit;
        }
    }
    if(isset($_GET['page_num'])){
         if($_GET['page_num'] > 1 && $_GET['page_num'] > $testimonyService->getCount()){
             $page_num = 1;
         }
         else if($_GET['page_num']>1){
            $page_num = $_GET['page_num'];
         }
    }
    if(isset($_GET["q"])){
       $testimonyList = $testimonyService->get($page_num, 10, $_GET["q"]);
    }else{
       $testimonyList = $testimonyService->get($page_num, 10);
    }
    $numberOfPages = $testimonyService->getNumberOfPages();

?>
<div class="container testimony-management">
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                
                <?php 
                  if(isset($_GET["error"])){
                      if($_GET["error"] == 1){
                        echo"<p class='error'>*You must supply a name</p>";
                      }
                      if($_GET["error"] == 3){
                        echo"<p class='error'>*You must supply a testimony</p>";
                      }
                      if($_GET["error"] == 3){
                        echo"<p class='error'>*testimony already exist</p>";
                      }
                      if($_GET["error"] == 9){
                        echo"<p class='error'>*Server error. contact admin.</p>";
                      }
                  }
                ?>
                <form action="<?= (isset($testimony))?'../actions/testimony-actions.php?id='.$testimony->getId():'../actions/testimony-actions.php'?>" method="post">
                    <input type="text" value="<?=(isset($testimony))?$testimony->getName():''?>" class="form-control" maxlength="20" name="name" placeholder="Person Name" required>
                    <div class="form-group">
                        <label for="details"></label>
                        <textarea id="details" type="text" name="comment" maxlength="120" placeholder="Testimony" class="form-control" id="detail" required><?=(isset($testimony))?$testimony->getComment():''?></textarea>
                    </div>
                    <button type="submit" class=""><?= (isset($testimony))?'Save Changes':'Create'?></button>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12"> 
            <div class="card">
                <form class="form-inline" >
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" name="q" style="width: 100%" placeholder="Search">
                    </div>
                    
                    <div class="col-sm-2"> 
                       <button type="submit" class="btn btn-block btn-success" style="height: 35px !important;">Go</button>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>testimony Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($testimonyList as $testimony) :?>
                        <tr>
                            <td><?= $testimony->getName()?></td>
                            <td><?= $testimony->getComment()?></td>
                            <td>
                                <a href=<?= './gallery-management.php?id='.$testimony->getId()?>>View Gallery</a> &nbsp|
                                <a href=<?= './testimony-management.php?id='.$testimony->getId()?>>Edit</a> &nbsp | &nbsp
                                <a href="<?='../actions/testimony-actions.php?id='.$testimony->getId().'&delete=yes'?>">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                 <div class="row text-center">
                <!--Pagination -->
                <nav aria-label="..." style=" position: relative; margin: auto 0;">
                <ul class="pagination pagination-sm">
                    <?php if($page_num != 1): ?>
                        <li class="page-item">
                        <a class="page-link" href="testimony-management.php?page_num=<?=$page_num - 1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for( $i =1; $i <= $numberOfPages; $i++):?>
                    
                    <li class="page-item <?=($page_num == $i)?'active':''?>"><a class="page-link" <?=($page_num == $i)?' ':"href= 'testimony-management.php?page_num=$i'"?> > <?=$i ?></a></li>
                        
                    <?php endfor;?>
                    

                    <?php if($page_num != $testimonyService->getNumberOfPages() &&  $testimonyService->getNumberOfPages() != 0): ?>
                        <li class="page-item">
                        <a class="page-link" href="testimony-management.php?page_num=<?=$page_num + 1?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                        </li>
                    <?php endif; ?>
                </ul>
                </nav>
                <!--end Pagination -->
              </div>
            </div>
        </div>
    </div>
</div>

              <br />
              <br />
              <br />

<?php require_once('footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>