<?php 
session_start();
$title = "Login";
?>
<?php require_once('header.php'); ?>      
<div class="container admin-login">
    <div class="row">
        <div class="col-md-4">
            </div>
            <div class="col-md-4">
                 <div class="card">
                    <h3>Login</h3>
                    <br>
                    <form action="../actions/login.php" method="post">
                        <input type="text" name="username"  class="form-control" placeholder="Username" required />
                        <input type="password" name="password"  class="form-control" placeholder="Password" required />
                        <p class="error"><?=(isset($_GET["error"]))?"*Invalid username or password":""?><p>
                        <button class="button" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                 
            </div>
    </div>

</div>
<?php require_once('footer.php'); ?>
