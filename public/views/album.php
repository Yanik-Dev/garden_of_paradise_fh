<?php
 session_start();
 require('../services/AlbumService.php');
 $title = "Albums";
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
<div class="container album-container">
 <h1>Albums</h1>  
<br>
<div class="row">
     <?php foreach($albumList as $album) :?>
  	    <div class="col-xs-3">
          <a href="<?= ".\\gallery.php?id=".$album->getId() ?>">
          <div  class="thumbnail">
              <img src="<?= ($album->getImages() != null)?'..\\uploads\\'.$album->getImages()[0]->getPath():'../assets/img/placeholder.png' ?>" />
              <div class="caption">
                <h4 class="title"><?= $album->getName() ?></h4>
                <p class="description"> <?= $album->getDescription() ?></p>
               </div>
          </div>
          </a>
        </div>
     <?php endforeach; ?>
      <?php if(count($albumList) < 1): ?>
          <div style="margin-bottom: 60px;">
            <center><h3>No Album has been added as yet </h3></center>
          </div>
     <?php endif; ?>
</div>
    
<div class="row text-center">
<!--Pagination -->
<nav aria-label="..." style=" position: relative; margin: auto 0;">
<ul class="pagination pagination-sm">
    <?php if($page_num != 1): ?>
        <li class="page-item">
        <a class="page-link" href="album.php?page_num=<?=$page_num - 1?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>
        </li>
    <?php endif; ?>
    
    <?php for( $i =1; $i <= $numberOfPages; $i++):?>
    
    <li class="page-item <?=($page_num == $i)?'active':''?>"><a class="page-link" <?=($page_num == $i)?' ':"href= 'album.php?page_num=$i'"?> > <?=$i ?></a></li>
        
    <?php endfor;?>
    

    <?php if($page_num != $albumService->getNumberOfPages() &&  $albumService->getNumberOfPages() != 0): ?>
        <li class="page-item">
        <a class="page-link" href="album.php?page_num=<?=$page_num + 1?>" aria-label="Next">
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
            
<?php require_once('footer.php'); ?>