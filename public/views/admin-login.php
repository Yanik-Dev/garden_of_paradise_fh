<?php 
session_start();
require('../services/UserService.php');
$title = "Login";
if(UserService::isLogin()){
     header("location: ./album-management.php");
    exit;
}
?>
<?php require_once('header.php'); ?>      
<div class="container admin-login">
    <div class="row">
        <div class="col-md-4">
            </div>
            <div class="col-md-4">
                 <div class="card">
                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                          Invalid username or password
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_GET['success'])): ?>
                        <div class="alert alert-success  alert-dismissible" role="alert"  id="error-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                            Your password has been changed.
                        </div>
                    <?php endif; ?>
                    <h3>Login</h3>
                    <br>
                    <form action="../actions/login.php" method="post">
                        <input type="text" name="username"  class="form-control" placeholder="Username" required />
                        <input type="password" name="password"  class="form-control" placeholder="Password" required />
                        <button class="button" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
    </div>

</div>
<?php require_once('footer.php'); ?>
