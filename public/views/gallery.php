<?php
ob_start();
require('../services/AlbumService.php');
 $title = "Gallery";
require_once('header.php');

    if(!isset($_GET['id'])){
        header('Location: ./album.php');
    }
    $albumService = new AlbumService();
    $album = $albumService->findOne($_GET['id']);
    $imageList = $album->getImages();
?>
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <div class="sub-gallery-nav">
      <h1> Gallery </h1>
      <h4> <?= 'Album: '.$album->getName() ?><h4>
    </div>
  </div>
</div>
</div>
<div class="container">
   <a href="./album.php" class="btn btn-danger" style="margin-bottom: 20px;">Back To Album</a>
 
    <div class="row">
     <?php $i = 0; foreach($imageList as $image) :?>
  	    <div class="col-xs-3">
          <a href="#" class="thumbnail">
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
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div>
</div>
<?php require_once('footer.php'); 
ob_end_flush();?>