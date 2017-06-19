<?php
 session_start();
 $page = 4;
 require('../services/ItemService.php');
 require('../services/CategoryService.php');
 $title = "Package Management";
 require_once('admin-sidebar.php');
?> 

<?php
    $itemService = new ItemService();
    $categoryService = new CategoryService();
    $page_num = 1;
    $item = null;
    if(!isset($_GET['cat_id'])){
         header("location: ./category-management.php");
        exit;
    }
    if($_GET['cat_id'] < 1){
        header("location: ./category-management.php");
        exit;
    }
    
    $category = CategoryService::findOne($_GET['cat_id']);
    
    if(isset($_GET["id"])){
        $item = itemService::findOne($_GET["id"]);
        if($item->getId() < 1){
            header("location: ./item-management.php?cat_id=".$_GET['cat_id']);
            exit;
        }
    }

    if(!isset($category)){
        header("location: ./category-management.php");
        exit;
    }

    if(isset($_GET['page_num'])){
         if($_GET['page_num'] > 1 && $_GET['page_num'] > $itemService->getCount()){
             $page_num = 1;
         }
         else if($_GET['page_num']>1){
            $page_num = $_GET['page_num'];
         }
    }
    if(isset($_GET["q"])){
       $itemList = $itemService->findAllByCategory($page_num, 5, $_GET["q"],$_GET["cat_id"]);
    }else{
       $itemList = $itemService->findAllByCategory($page_num, 5, '', $_GET["cat_id"]);
    }
    $numberOfPages = $itemService->getNumberOfPages();

?>
<style>
  .card{
      min-height: 500px;
      height: auto !important;
  }
</style>
<div class="container item-management">
        <a href="./category-management.php" class="btn btn-danger" style="margin-bottom: 20px;">Back To Categories</a>
    <div class="row">
        <h2>Category: <?=$category->getName()?> </h2>
        
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="card">
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <?php if($_GET['error'] == 2): ?>
                            Item already exist
                        <?php endif; ?>
                        <?php if($_GET['error'] == 5): ?>
                           Images must be JPEG or PNG
                        <?php endif; ?>
                        <?php if($_GET['error'] == 1): ?>
                           You must supply a name
                        <?php endif; ?>
                        <?php if($_GET['error'] == 3): ?>
                           You must supply a description
                        <?php endif; ?>
                        <?php if($_GET['error'] == 9): ?>
                           Server error. contact admin.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <form action="<?= (isset($item))?'../actions/item-actions.php?id='.$item->getId().'&cat_id='.$_GET['cat_id']:'../actions/item-actions.php?cat_id='.$_GET['cat_id']?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="<?=$category->getId()?>" class="form-control" name="category">
                    <div class="form-group">
                        <label for="" style="float:left">Image of Item</label>
                        <input type="file" name="file" id="">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                    <input type="text" value="<?=(isset($item))?$item->getName():''?>" class="form-control" name="name" placeholder="item Name" maxlength="120" required>
                    </div>
                    <div class="form-group">
                        <textarea style="text-align: left;" class="form-control" name="description" placeholder="Item Description" required><?=(isset($item))?$item->getDescription():''?></textarea>
                    </div>

                    <button type="submit" class="cust-btn"><?= (isset($item))?'Save Changes':'Insert'?></button>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12"> 
            <div class="card">
                <form class="form-inline" >
                    <div class="col-sm-10"> 
                        <input type="text" class="form-control" style="width:100%" name="q" placeholder="Search">
                    </div>
                    
                    <div class="col-sm-2"> 
                       <button type="submit" class="cust-btn" style="height: 35px !important;">Search</button>
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>item Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($itemList as $item) :?>
                        <tr>
                            <td><?= '<img src="'.$item->getPath().'" width="50px" height="50px">'?></td>
                            <td><?= $item->getName()?></td>
                            <td><?= $item->getDescription()?></td>
                            <td>
                                <a href=<?= './item-management.php?id='.$item->getId().'&cat_id='.$_GET['cat_id']?>>Edit</a> &nbsp | &nbsp
                                <a href="<?='../actions/item-actions.php?id='.$item->getId().'&delete=yes'.'&cat_id='.$_GET['cat_id']?>">Delete</a>
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
                        <a class="page-link" href="item-management.php?page_num=<?=($page_num - 1).'&cat_id='.$_GET['cat_id']?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for( $i =1; $i <= $numberOfPages; $i++):?>
                    
                    <li class="page-item <?=($page_num == $i)?'active':''?>"><a class="page-link" <?=($page_num == $i)?' ':'href= "item-management.php?page_num='.$i.'&cat_id='.$_GET['cat_id'].'"'?> > <?=$i ?></a></li>
                        
                    <?php endfor;?>
                    

                    <?php if($page_num != $itemService->getNumberOfPages() &&  $itemService->getNumberOfPages() != 0): ?>
                        <li class="page-item">
                        <a class="page-link" href="item-management.php?page_num=<?=($page_num + 1).'&cat_id='.$_GET['cat_id']?>" aria-label="Next">
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