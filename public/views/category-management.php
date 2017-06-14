<?php
 session_start();
 $page = 4;
 require('../services/CategoryService.php');
 $title = "Package Management";
 require_once('admin-sidebar.php');
?> 

<?php
    $categoryService = new CategoryService();
    $page_num = 1;
    $category = null;
    if(isset($_GET["id"])){
        $category = categoryService::findOne($_GET["id"]);
        if($category->getId() < 1){
            header("location: ./category-management.php");
            exit;
        }
    }
    if(isset($_GET['page_num'])){
         if($_GET['page_num'] > 1 && $_GET['page_num'] > $categoryService->getCount()){
             $page_num = 1;
         }
         else if($_GET['page_num']>1){
            $page_num = $_GET['page_num'];
         }
    }
    if(isset($_GET["q"])){
       $categoryList = $categoryService->get($page_num, 8, $_GET["q"]);
    }else{
       $categoryList = $categoryService->get($page_num, 8);
    }
    $numberOfPages = $categoryService->getNumberOfPages();

?>
<div class="container category-management">
    <h3> Item Categories </h3>
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <?php if($_GET['error'] == 2): ?>
                            Category already exist
                        <?php endif; ?>
                        <?php if($_GET['error'] == 1): ?>
                           You must supply a category name
                        <?php endif; ?>
                        <?php if($_GET['error'] == 9): ?>
                           Server error. contact admin.
                        <?php endif; ?>
                        <?php if($_GET['error'] == 10): ?>
                           Cannot add more than 10 categories.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <form action="<?= (isset($category))?'../actions/category-actions.php?id='.$category->getId():'../actions/category-actions.php'?>" method="post">
                    <input type="text" value="<?=(isset($category))?$category->getName():''?>" class="form-control" name="name" style="width: 100%" placeholder="category Name">

                    <button type="submit" style="margin-top: 20px" class="cust-btn"><?= (isset($category))?'Save Changes':'Create'?></button>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12"> 
            <div class="card">
                <form class="form-inline" >
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" style="width: 100%" name="q" placeholder="Search">
                    </div>
                    
                    <div class="col-sm-2"> 
                       <button type="submit" class="cust-btn" style="height: 35px !important;">Search</button>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category name</th>
                            <th>Number of Items</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categoryList as $category) :?>
                        <tr>
                            <td><?= $category->getName()?></td>
                            <td><?= count($category->getItems())?></td>
                            <td>
                                <a href=<?= './item-management.php?cat_id='.$category->getId()?>>View Items</a> &nbsp|
                                <a href=<?= './category-management.php?id='.$category->getId()?>>Edit</a> &nbsp | &nbsp
                                <a href="<?='../actions/category-actions.php?id='.$category->getId().'&delete=yes'?>">Delete</a>
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
                        <a class="page-link" href="category-management.php?page_num=<?=$page_num - 1?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for( $i =1; $i <= $numberOfPages; $i++):?>
                    
                    <li class="page-item <?=($page_num == $i)?'active':''?>"><a class="page-link" <?=($page_num == $i)?' ':"href= 'category-management.php?page_num=$i'"?> > <?=$i ?></a></li>
                        
                    <?php endfor;?>
                    

                    <?php if($page_num != $categoryService->getNumberOfPages() &&  $categoryService->getNumberOfPages() != 0): ?>
                        <li class="page-item">
                        <a class="page-link" href="category-management.php?page_num=<?=$page_num + 1?>" aria-label="Next">
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

<?php require_once('admin-footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>