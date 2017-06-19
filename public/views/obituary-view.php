<?php 
 $title = "Obituary";
 require('../services/ObituaryService.php');
 
 if(!isset($_GET['id'])){
     header("Location: obituary.php");
     exit;
 }
 $id = $_GET['id'];
 if(!is_numeric($id)){
     header("Location: obituary.php");
     exit;
 }

 $person = ObituaryService::findOne($id);

 if(!isset($person)){
     header("Location: obituary.php");
     exit;
 }
?>
<?php require_once('header.php'); ?>  
<style>
.card{
    
    height: auto !important;
}
</style>
<div class="container-fiuld">
<div class="dedication-container container">
   <div class="row">
    <div class="col-md-12">
        <div class="text">
            <center> 
           <div class="woman">
             <img src="<?=($person->getPath() == null)?'../assets/img/blank.png':$person->getPath()?>">
           </div>
        </center>
            <center>
            <h1><?= $person->getName() ?></h1>
            <h3><?= $person->getDate() ?></h3>
            </center>
        </div>
    </div>
    
    <div class="col-md-12" style="padding: 20px">
        <div class="text">
         <?= $person->getDetails() ?>
      </div>
    </div>
  </div>
</div>
</div>
<?php require_once('footer.php'); ?>


