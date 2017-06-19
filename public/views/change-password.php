<?php
 session_start();
 $page = 5;
 require_once('../services/UserService.php');
 require_once('../classes/User.php');
 require_once('../common/Security.php');
 $title = "Change Password";
 require_once('admin-sidebar.php');
?> 

<?php
    $userService = new UserService();
      
    if(isset($_POST['submit'])){
        if(strcmp($_POST['confirm_password'], $_POST['new_password'])!=0){
            header("location: ./change-password.php?error=3");
            exit;
        }
        
        $user = new User();
        $user->setUsername($userService->getUserSession()["username"]);

        $hash = Security::getHash($_POST["old_password"], $userService->getUserSession()["salt"]);
        if(strcmp("".$userService->getUserSession()["password"]."", "".$hash."") == 0){
            $salt = Security::getSalt();
            $hash = Security::getHash($_POST["new_password"], $salt);
            $user->setPassword($hash);
            $user->setSalt($salt);
            echo"yyy";
            if($userService->update($user)){
                $userService->unsetUserSession();
                header("location: ./admin-login.php?success=1");
                exit;
            }
        }else{
            header("location: ./change-password.php?error=1");
            exit;
        }

    }
?>
<div class="container obituary-management" style="padding-right: 50px;">
    <h3> Change Password </h3>
     <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
              <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <?php if($_GET['error'] == 1): ?>
                           Your old password is incorrect
                        <?php endif; ?>
                        <?php if($_GET['error'] == 3): ?>
                          New passwords don't match
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <form action="./change-password.php" method="post">
                
                    <div class="form-group">
                      <input type="password"  class="form-control" name="old_password" minlength="2" maxlength="90" placeholder="Old Password" required>
                    </div>
                    <div class="form-group">
                      <input type="password"  class="form-control" name="new_password" placeholder="New password" required>
                    </div>
                    <div class="form-group">
                      <input type="password"  class="form-control" name="confirm_password" placeholder="Confrim new password" required>
                    </div>
                    <button type="submit" name="submit" class="cust-btn">Save New Password</button>
                </form>
                <br />
                <br />
                <br />
        </div>
        </div>

</div>

<?php require_once('admin-footer.php'); ?>

<script src='../assets/lib/ckeditor/ckeditor.js'></script>