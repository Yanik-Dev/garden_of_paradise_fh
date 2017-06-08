<?php 
$title = "Testimonals";

require('../services/TestimonyService.php');
 
 $testimonyService = new TestimonyService();
    $page_num = 1;
    $album = null;

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
<?php require_once('header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 obituary-content">
              <center>
                 <h1>Testimonals</h1>
              </center>
            <div class="search-result">  
               <?php foreach($testimonyList as $testimony) : ?>  
                    <div class="row search-item">
                        <div class="col-md-12">
                            <blockquote>
                                <p>"<?= $testimony->getComment() ?>"</p>
                            <footer><cite title="Source Title"><?= $testimony->getName() ?></cite></footer>
                            </blockquote>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <?php if(count($testimonyList) < 1): ?>
                  <center><h3>No Testimonals available </h3></center>
                <?php endif; ?>
            </div>
            <div class="row text-center">
                <!--Pagination -->
                <nav aria-label="..." style=" position: relative; margin: auto 0;">
                <ul class="pagination pagination-sm">
                    <?php if($page_num != 1): ?>
                        <li class="page-item">
                        <a class="page-link" href="obituary.php?page_num=<?=$page_num - 1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for( $i =1; $i <= $numberOfPages; $i++):?>
                    
                    <li class="page-item <?=($page_num == $i)?'active':''?>"><a class="page-link" <?=($page_num == $i)?' ':"href= 'obituary.php?page_num=$i'"?> > <?=$i ?></a></li>
                        
                    <?php endfor;?>
                    

                    <?php if($page_num != $testimonyService->getNumberOfPages() &&  $testimonyService->getNumberOfPages() != 0): ?>
                        <li class="page-item">
                        <a class="page-link" href="obituary.php?page_num=<?=$page_num + 1?>" aria-label="Next">
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
        <div class="col-md-4">
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>