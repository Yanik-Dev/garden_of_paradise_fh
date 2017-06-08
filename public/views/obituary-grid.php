<?php 
$title = "Obituary";

require('../services/ObituaryService.php');
 
 $obituaryService = new ObituaryService();
    $page_num = 1;
    $album = null;

    if(isset($_GET['page_num'])){
         if($_GET['page_num'] > 1 && $_GET['page_num'] > $obituaryService->getCount()){
             $page_num = 1;
         }
         else if($_GET['page_num']>1){
            $page_num = $_GET['page_num'];
         }
    }
    if(isset($_GET["q"])){
       $obituaryList = $obituaryService->getByLimit($page_num, 10, $_GET["q"]);
    }else{
       $obituaryList = $obituaryService->getByLimit($page_num, 10);
    }
    $numberOfPages = $obituaryService->getNumberOfPages();
?>
<?php require_once('header.php'); ?>
<div class="container">
 <div class="col-md-12"> 
            <div class="card" style="min-height: 350px !important">
                <form class="form-inline" >
                    <div class="col-md-10"> 
                        <input type="text" class="form-control" name="q"  style="width: 100%" placeholder="Search">
                    </div>
                    
                    <div class="col-md-2"> 
                    <button type="submit" class="btn btn-block btn-sucess">Go</button>
                    </div>
                </form>
                <br />
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach($obituaryList as $obituary) : ?>  
                        <tr>
                            <td><?= $obituary->getName()?></td>
                            <td><?= $obituary->getDate()?></td>
                            <td><?= $obituary->getDetails()?></td>
                            <td>
                                <a href=<?= './obituary-view.php?id='.$obituary->getId()?>>View</a> &nbsp|
                                <a href=<?= './obituary-management.php?id='.$obituary->getId()?>>Edit</a> &nbsp | &nbsp
                                <a href="<?='../actions/obituary-actions.php?id='.$obituary->getId().'&delete=yes'?>">Delete</a>
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
                        <a class="page-link" href="obituary-grid.php?page_num=<?=$page_num - 1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for( $i =1; $i <= $numberOfPages; $i++):?>
                    
                    <li class="page-item <?=($page_num == $i)?'active':''?>"><a class="page-link" <?=($page_num == $i)?' ':"href= 'obituary-grid.php?page_num=$i'"?> > <?=$i ?></a></li>
                        
                    <?php endfor;?>
                    

                    <?php if($page_num != $obituaryService->getNumberOfPages() &&  $obituaryService->getNumberOfPages() != 0): ?>
                        <li class="page-item">
                        <a class="page-link" href="obituary-grid.php?page_num=<?=$page_num + 1?>" aria-label="Next">
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