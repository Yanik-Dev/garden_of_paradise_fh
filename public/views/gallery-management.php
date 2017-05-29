<?php
 session_start();
 require('../services/AlbumService.php');
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

<div class="container">
    <form>

  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" name="files[]" id="exampleInputFile" multiple>
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
    <div class="row">
     <?php $i = 0; foreach($albumList as $album) :?>
  	    <div class="col-xs-3">
              
          <a href="#" > <span class="glyphicon glyphicon-remove danger"></span></a>
          <a href="#" class="thumbnail">
              <img src="../assets/img/mark.png"/>
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
