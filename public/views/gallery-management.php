<?php
 session_start();
 require('../services/ImageService.php');
 $title = "Gallery Management";
 require_once('header.php');
?> 
<style>
.controls{
    width:50px;
    display:block;
    font-size:11px;
    padding-top:8px;
    font-weight:bold;
}
.next {
    float:right;
    text-align:right;
}
</style>
<?php
    if(!isset($_GET['id'])){
        header('Location: ./album-management.php');
    }
    $imageService = new ImageService();
    if(isset($_GET['img_id']) && isset($_GET['delete'])){
        $imageService->delete($_GET['img_id']);
         header('Location: ./gallery-management.php?id='.$_GET['id']);
    }
    
    $imageList = $imageService->getImagesbyLimit(1, 20, $_GET['id']);
?>

<div class="container">
  <form action="../actions/gallery-upload-action.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" name="files[]" id="exampleInputFile" multiple>
            <input type="hidden" name="album" id="" value=<?= $_GET['id'] ?>>
            <p class="help-block">Example block-level help text here.</p>
        </div>
    <button type="submit" class="btn btn-default">Submit</button>
   </form>
    <div class="row">
     <?php $i = 0; foreach($imageList as $image) :?>
  	    <div class="col-xs-3">
          <a href="<?= './gallery-management.php?id='.$_GET['id'].'&img_id='.$image['id'].'&delete=yes' ?>" > <span class="glyphicon glyphicon-remove" style="color:red;"></span></a>
          <a href="#" class="thumbnail">
              <img src="<?= '..\\uploads\\'.$image['path'] ?>" />
          </a>
        </div>
        <?php endforeach; ?>
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
