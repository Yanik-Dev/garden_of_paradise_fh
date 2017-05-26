<!doctype html>
<html>
    <head> 
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Garden Of Paradise - <?=$title?> </title>
      <link rel="stylesheet" type="Text/css" href="../assets/lib/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="Text/css" href="../assets/css/style.css">
      <link rel="stylesheet" href="../assets/css/animate.css">
    </head>
    <body>
    <div class="header">
        <div class="container-fluid social-bar">
            <div class ="container ">
                <a href="#"><img src="../assets/img/icons/facebook.svg" class="social-icon" alt=""> </a>
                <a href="#"><img src="../assets/img/icons/twitter.svg" class="social-icon" alt=""></a>
                <a href="#" id="location"> 
                  <img style="border: 5px solid #E0E0E0"src="../assets/img/phone.jpg" width="40px" height="40px" class="" alt="" align="left">              
                  (1-876) 327-9729 | (1-876) 870-5848 
                </a>
            </div>
             
            </div>
          
        <div class="container-fluid">
            <div class ="container header-content">
              <div class="row">
                  <div class="col-md-4 " ></div>
                  <div class="col-md-4" >
                      <div class="header-frame">
                         <center><a href="#"><img src="../assets/img/logo.png"  class="img-responsive" alt=""> </a></center>
                      </div>
                      <center>
                  <h3>Granting Relief in Times of Grief</h3>
                </center>
                  </div>
                  <div class="col-md-4" ></div>
                </div>
              </div>
            </div>
        </div>
         <nav class="navbar navbar-default">
          <div class="container">
          <div class="navbar-header">
            <button type="button"  class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="nav-bar" href="#">Garden Of Paradise FH</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="./home.php" class="<?= ($title =="Home")?'nav-active':''?>">Home</a></li>
              <li><a href="./obituary.php" class="<?= ($title =="Obituary")?'nav-active':''?>">Obituary</a></li>
              <li><a href="./dedication.php" class="<?= ($title =="Dedication")?'nav-active':''?>">Dedication</a></li>
              <li><a href="./gallery.php" class="<?= ($title =="Gallery")?'nav-active':''?>">Gallery</a></li>
              <li><a href="./about-us.php" class="<?= ($title =="About Us")?'nav-active':''?>">About Us</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services & Packages<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="./services.php" class="<?= ($title =="Services")?'nav-active':''?>">Services</a></li>
                  <li><a href="./packages.php" class="<?= ($title =="Packages")?'nav-active':''?>">Packages</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="./contact-us.php" class="<?= ($title =="Contact Us")?'nav-active':''?>">Contact Us</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    </div>
    <div class="back-to-top">
      <a href="#">Back to top</a>
    </div>