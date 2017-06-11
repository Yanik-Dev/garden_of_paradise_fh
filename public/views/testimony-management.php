<?php
 session_start();

 $page = 2;
 $title = "Testimonal Management";
 require('../services/AlbumService.php');
 require_once('admin-sidebar.php');
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
<div class="container testimony-management" style="padding-right: 50px;">
    <h3> Testimonals </h3>
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <?php if($_GET['error'] == 2): ?>
                            testimony already exist
                        <?php endif; ?>
                        <?php if($_GET['error'] == 1): ?>
                           You must supply a name
                        <?php endif; ?>
                        <?php if($_GET['error'] == 3): ?>
                           You must supply a testimony
                        <?php endif; ?>
                        <?php if($_GET['error'] == 9): ?>
                        Server error. contact admin.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <form action="<?= (isset($testimony))?'../actions/testimony-actions.php?id='.$testimony->getId():'../actions/testimony-actions.php'?>" method="post">
                    <input type="text" value="<?=(isset($testimony))?$testimony->getName():''?>" class="form-control" maxlength="20" name="name" placeholder="Person Name" required>
                    <div class="form-group">
                        <label for="details"></label>
                        <textarea id="details" type="text" name="comment" maxlength="120" placeholder="Testimony" class="form-control" id="detail" required><?=(isset($testimony))?$testimony->getComment():''?></textarea>
                    </div>
                    <button type="submit" class="cust-btn"><?= (isset($testimony))?'Save Changes':'Insert'?></button>
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
                       <button type="submit" class="cust-btn" style="height: 35px !important;">Search</button>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>testimony Name</th>
                            <th>Comment</th>
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

<?php require_once('admin-footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>