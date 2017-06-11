<?php 

 $title="Customize Package";

 require('../services/ItemService.php');
 require('../services/CategoryService.php');

 $itemService = new ItemService();
 $categoryService = new CategoryService();

 $categories = $categoryService->get(1,10);
?>

<?php require_once('header.php'); ?>
<!-- Steps Progress and Details - START -->
<div class="container" style="margin-top: 20px; margin-bottom: 100px;">
    <div class="page-header">
        <h1>Customize your package</h1>
        <h4><small>Bootstrap template, demonstrating steps, progress indicator and additional info.</small></h4>
    </div>
    <?php 
        if(isset($_GET["error"])){
            if($_GET["error"] == 1){
                echo"<p class='error'>*There was an error sending your quote</p>";
            }
            if(isset($_GET["error-name"])){
                echo"<p class='error'>*Your name is required</p>";
            }
            if(isset($_GET["error-num"])){
                echo"<p class='error'>*A valid phone number is required</p>";
            }
            if(isset($_GET["error-email"])){
                echo"<p class='error'>*A valid email is required</p>";
            }
            if(isset($_GET["error-message"])){
                echo"<p class='error'>*A message is required</p>";
            }
        }
    ?>
    <div class="row">
       <!-- <div class="progress" id="progress1">
            <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
            </div>
            <span class="progress-type">Overall Progress</span>
            <span class="progress-completed">20%</span>
        </div> -->
    </div>
    <div class="row">
        <div class="row step">
            <?php foreach($categories as $category): ?>
                <div id="div1" class="col-md-2 activestep" onclick="javascript: resetActive(event, 0, 'step-<?=$category->getId()?>');">
                    <p><?= $category->getName()?></p>
                </div>
            <?php endforeach; ?>
            <div class="col-md-2" onclick="javascript: resetActive(event, 80, 'step-final');">
                <p>Submit Request</p>
            </div>
        </div>
    </div>
    
    <form action="" method="post">
        <?php foreach($categories as $category): ?>
            <div class="row setup-content step activeStepInfo " id="step-<?=$category->getId()?>">
                <div class="col-xs-12">
                    <div class="col-md-12 well text-center">
                        <h1><?= $category->getName()?></h1>
                        <?php $items = $category->getItems(); ?>
                        
                       
                         <div class="row">
                            <?php foreach($items as $item): ?>
                            <div class="col-xs-3">
                                
                               <input type="radio" name="<?=$category->getName()?>" 
                                                   value="<?= $item->getName() ?>"
                                                   class="form-control" id="<?= $item->getId() ?>" style="padding:10px">
                                <a  class="thumbnail">
                                    <img src="<?= '..\\uploads\\'.$item->getPath() ?>" />
                                    <div class="caption">
                                        <h4 class="title"><?= $item->getName() ?></h4>
                                        <p class="description"> <?= $item->getDescription() ?></p>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; ?>
                            <?php if(count($items) < 1): ?>
                            <div style="margin-bottom: 60px;">
                                <center><h3>No Items have been added to this category as yet </h3></center>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <div class="row setup-content step hiddenStepInfo" id="step-final">
        <div class="col-xs-12">
            <div class="col-md-12 well text-center">
                <h1>Request Quotation</h1>
                <div class="line"></div>
                <div class="request">
                    
                    <p class="success"><?=(isset($_GET["success"]))?"Your message has been sent successfully!":""?><p>
                    <div class="form-group">
                     <input type="text" name="name"  class="form-control" placeholder="Name *" colspan="4" required maxlength="15" />
                    </div>
                    <div class="form-group">
                     <input type="email" name="email"  class="form-control" placeholder="Email *" />
                     </div>
                     <div class="form-group">
                    <input type="tel" name="tel"  class="form-control" placeholder="000 000 0000 *" required pattern="[876][0-9]{9}" />
                    </div>
                    <textarea rows="6" cols="" name="message" placeholder="additional requests" class="form-control"></textarea>
                    <center> <button class="button" type="submit">Send Request</button></center>
                
            </div>
        </div>
    </div>
</div>
    </form>
    </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
.hiddenStepInfo {
    display: none;
}

.activeStepInfo {
    display: block !important;
}

.underline {
    text-decoration: underline;
}

.step {
    margin-top: 27px;
}

.progress {
    position: relative;
    height: 25px;
}

.progress > .progress-type {
    position: absolute;
    left: 0px;
    font-weight: 800;
    padding: 3px 30px 2px 10px;
    color: rgb(255, 255, 255);
    background-color: rgba(25, 25, 25, 0.2);
}

.progress > .progress-completed {
    position: absolute;
    right: 0px;
    font-weight: 800;
    padding: 3px 10px 2px;
}

.step {
    text-align: center;
}

.step .col-md-2 {
    background-color: #fff;
    border: 1px solid #C0C0C0;
    border-right: none;
}

.step .col-md-2:last-child {
    border: 1px solid #C0C0C0;
}

.step .col-md-2:first-child {
    border-radius: 5px 0 0 5px;
}

.step .col-md-2:last-child {
    border-radius: 0 5px 5px 0;
}

.step .col-md-2:hover {
    color: #F58723;
    cursor: pointer;
}

.step .activestep {
    color: #F58723;
    height: 100px;
    margin-top: -7px;
    padding-top: 7px;
    border-left: 6px solid #5CB85C !important;
    border-right: 6px solid #5CB85C !important;
    border-top: 3px solid #5CB85C !important;
    border-bottom: 3px solid #5CB85C !important;
    vertical-align: central;
}

.step .fa {
    padding-top: 15px;
    font-size: 40px;
}
</style>



<!-- Steps Progress and Details - END -->

<?php require_once('footer.php'); ?>
<script type="text/javascript">
    function resetActive(event, percent, step) {
        $(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
        $(".progress-completed").text(percent + "%");

        $("div").each(function () {
            if ($(this).hasClass("activestep")) {
                $(this).removeClass("activestep");
            }
        });

        if (event.target.className == "col-md-2") {
            $(event.target).addClass("activestep");
        }
        else {
            $(event.target.parentNode).addClass("activestep");
        }

        hideSteps();
        showCurrentStepInfo(step);
    }

    function hideSteps() {
        $("div").each(function () {
            if ($(this).hasClass("activeStepInfo")) {
                $(this).removeClass("activeStepInfo");
                $(this).addClass("hiddenStepInfo");
            }
        });
    }

    function showCurrentStepInfo(step) {        
        var id = "#" + step;
        $(id).addClass("activeStepInfo");
    }
</script>

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