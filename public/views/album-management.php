<?php
 session_start();
 $page = 1;
 require('../services/AlbumService.php');
 $title = "Album Management";
 require_once('admin-sidebar.php');
?> 

<?php
    $albumService = new AlbumService();
    $page_num = 1;
    $album = null;
    if(isset($_GET["id"])){
        $album = AlbumService::findOne($_GET["id"]);
        if($album->getId() < 1){
            header("location: ./album-management.php");
            exit;
        }
    }
    if(isset($_GET['page_num'])){
         if($_GET['page_num'] > 1 && $_GET['page_num'] > $albumService->getCount()){
             $page_num = 1;
         }
         else if($_GET['page_num']>1){
            $page_num = $_GET['page_num'];
         }
    }
    if(isset($_GET["q"])){
       $albumList = $albumService->getAlbumbyLimit($page_num, 10, $_GET["q"]);
    }else{
       $albumList = $albumService->getAlbumbyLimit($page_num, 10);
    }
    $numberOfPages = $albumService->getNumberOfPages();

?>
<style>
  .card{
      
    height: auto !important;
  }
</style>
<div class="container album-management" style="padding-right: 50px;">
    <h3> Albums </h3>
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <?php if($_GET['error'] == 2): ?>
                            Album already exist
                        <?php endif; ?>
                        <?php if($_GET['error'] == 1): ?>
                           You must supply a album name
                        <?php endif; ?>
                        <?php if($_GET['error'] == 9): ?>
                        Server error. contact admin.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <form action="<?= (isset($album))?'../actions/album-actions.php?id='.$album->getId():'../actions/album-actions.php'?>" method="post">
                    <input type="text" value="<?=(isset($album))?$album->getName():''?>" class="form-control" name="name" placeholder="Album Name">
                    <div class="form-group">
                        <label for="details"></label>
                        <textarea id="details" type="text" name="description" maxlength="120" placeholder="Description" class="form-control" id="detail" required><?=(isset($album))?$album->getDescription():''?></textarea>
                    </div>
                    <button type="submit" class=""><?= (isset($album))?'Save Changes':'Create'?></button>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12"> 
            <div class="card">
                <form class="form-inline" >
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" name="q" placeholder="Search">
                    </div>
                    
                    <div class="col-sm-2"> 
                       <button type="submit" class="" style="height: 35px !important;">Go</button>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Album Name</th>
                            <th>Description</th>
                            <th>Number of Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($albumList as $album) :?>
                        <tr>
                            <td><?= $album->getName()?></td>
                            <td><?= $album->getDescription()?></td>
                            <td><?= count($album->getImages())?></td>
                            <td>
                                <a href=<?= './gallery-management.php?id='.$album->getId()?>>View Gallery</a> &nbsp|
                                <a href=<?= './album-management.php?id='.$album->getId()?>>Edit</a> &nbsp | &nbsp
                                <a href="<?='../actions/album-actions.php?id='.$album->getId().'&delete=yes'?>">Delete</a>
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
                        <a class="page-link" href="album-management.php?page_num=<?=$page_num - 1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for( $i =1; $i <= $numberOfPages; $i++):?>
                    
                    <li class="page-item <?=($page_num == $i)?'active':''?>"><a class="page-link" <?=($page_num == $i)?' ':"href= 'album-management.php?page_num=$i'"?> > <?=$i ?></a></li>
                        
                    <?php endfor;?>
                    

                    <?php if($page_num != $albumService->getNumberOfPages() &&  $albumService->getNumberOfPages() != 0): ?>
                        <li class="page-item">
                        <a class="page-link" href="album-management.php?page_num=<?=$page_num + 1?>" aria-label="Next">
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

<?php require_once('admin-footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>