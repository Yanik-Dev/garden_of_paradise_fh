<?php
 session_start();
 $page = 5;
 require('../services/UserService.php');
 $title = "Change Password";
 require_once('admin-sidebar.php');
 
?> 

<?php
    $userService = new UserService();
?>
<div class="container obituary-management" style="padding-right: 50px;">
    <h3> Change Password </h3>
     <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <?php if($_GET['error'] == 2): ?>
                            Person already exist
                        <?php endif; ?>
                        <?php if($_GET['error'] == 5): ?>
                           Images must be JPEG or PNG
                        <?php endif; ?>
                        <?php if($_GET['error'] == 1): ?>
                           Your old password is incorrect
                        <?php endif; ?>
                        <?php if($_GET['error'] == 3): ?>
                          Passwords donot match
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <form action="<?= (isset($obituary))?'../actions/obituary-actions.php?id='.$obituary->getId():'../actions/obituary-actions.php'?>" method="post" enctype="multipart/form-data">
                
                    <div class="form-group">
                      <input type="text"  class="form-control" name="old_password" minlength="2" maxlength="90" placeholder="Old Password" required>
                    </div>
                    <div class="form-group">
                      <input type="text"  class="form-control" name="new_password" placeholder="New password" required>
                    </div>
                    <div class="form-group">
                      <input type="text"  class="form-control" name="confirm_password" placeholder="Confrim new password" required>
                    </div>
                    <button type="submit" name="" class="cust-btn">Save new Password</button>
                </form>
                <br />
                <br />
                <br />
        </div>
        </div>

</div>

<?php require_once('admin-footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>