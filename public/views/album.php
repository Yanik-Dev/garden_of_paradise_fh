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

<style>
.card{
    text-align:left;
    min-height: 600px;
    height: auto !important;
    margin-bottom: 40px;
}
body{
    overflow-x: hidden;
}
</style>
<div class="container card">
      <img src="../assets/img/leaf.png" class="img-responsive card-leaf-left"  width="70px" height="120px" style="" alt="" > 
      <img src="../assets/img/leaf_flip.png" class="img-responsive card-leaf-top-right"  width="70px" height="120px" alt="" > 
		
 <h1 align="center">Our Gallery</h1>  
<br>
<div class="row">
     <?php foreach($albumList as $album) :?>
              <div class="col-md-12">
                <h4 class="title"><?= $album->getName() ?></h4>
                <p class="description"> <?= $album->getDescription() ?></p>
               </div>
       <div class="row">
        <?php $imageList = $album->getImages(); foreach($imageList as $image) :?>
            <div class="col-xs-3">
            <a class="thumbnail gallery" style="border-radius: 0; padding: 0" data-toggle="tooltip" data-placement="top" title="click to view larger">
                <img src="<?= '..\\uploads\\'.$image->getPath() ?>" />
            </a>
            </div>
            <?php endforeach; ?>
            <?php if(count($imageList) < 1): ?>
            <div style="margin-bottom: 60px;">
                <center><h3>No Images has been added to this album as yet </h3></center>
            </div>
            <?php endif; ?>
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
<div style="z-index: 999999999" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php require_once('footer.php'); ?>
<script>
    $(document).ready(function(){
   $('a img').on('click',function(){
        var src = $(this).attr('src');
        var img = '<img src="' + src + '" class="img-responsive"/>';

          //Start of new code
        var index = $(this).parent('a').index();
        var html = '';
        html += img;
        html += '<div style="height:25px;clear:both;display:block;">';
        html += '<a class="controls next" href="'+ (index+2) + '">next &raquo;</a>';
        html += '<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
        html += '</div>';
        //End of new code

        $('#myModal').modal();
        $('#myModal').on('shown.bs.modal', function(){
            $('#myModal .modal-body').html(img);
        });
        $('#myModal').on('hidden.bs.modal', function(){
            $('#myModal .modal-body').html('');
        });
   });
})
</script>