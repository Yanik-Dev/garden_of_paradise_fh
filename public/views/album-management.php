<?php
 session_start();
 require('../services/AlbumService.php');
 $title = "Album Management";
 require_once('header.php');
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
<div class="container album-management">
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                
                <?php 
                  if(isset($_GET["error"])){
                      if($_GET["error"] == 1){
                        echo"<p class='error'>*You must supply a album name</p>";
                      }
                      if($_GET["error"] == 2){
                        echo"<p class='error'>*Album already exist</p>";
                      }
                      if($_GET["error"] == 9){
                        echo"<p class='error'>*Server error. contact admin.</p>";
                      }
                  }
                ?>
                <p>
                <form action="<?= (isset($album))?'../actions/album-actions.php?id='.$album->getId():'../actions/album-actions.php'?>" method="post">
                    <input type="text" value="<?=(isset($album))?$album->getName():''?>" class="form-control" name="name" placeholder="Album Name">
                    <div class="form-group">
                        <label for="details">Description</label>
                        <textarea id="details" type="text" name="description" class="ckeditor" id="detail" required><?=(isset($album))?$album->getDescription():''?></textarea>
                    </div>
                    <button type="submit" class=""><?= (isset($album))?'Save Changes':'Create'?></button>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12"> 
            <div class="card">
                <form class="form-inline" >
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" name="q" placeholder="Search">
                    </div>
                    
                    <div class="col-sm-2"> 
                    <button type="submit" class="">Go</button>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Album Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($albumList as $album) :?>
                        <tr>
                            <td><?= $album->getName()?></td>
                            <td><?= $album->getDescription()?></td>
                            <td>
                                <a href="">View Gallery</a> &nbsp|
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

<?php require_once('footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>