<!Doctype html>
<html>
    <head> 
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Garden Of Paradise - <?=$title?> </title>
      <link rel="shortcut icon" type="image/ico" href="./favicon.ico"/>
      <link rel="stylesheet" type="Text/css" href="../assets/lib/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="Text/css" href="../assets/css/style.css">
      <link rel="stylesheet" href="../assets/css/animate.css">
    </head>
    <body>
    <div class="header">
        <div class="container-fluid social-bar">
            <div class ="container ">
                <div class="animated fadeInDown">
                <a href="./services.php"><img src="../assets/img/icons/24hours.svg" style="color: #592131" class="social-icon" alt=""> </a>
                <a href="./obituary.php"><img src="../assets/img/icons/paper.svg" class="social-icon" alt=""></a>
                </div>
                <a href="./contact-us.php" class="animated lightSpeedIn" id="location" style="color: #592131; text-decoration: none"> 
                  (1-876) 327-9729 | (1-876) 870-5848 
                </a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="social-sidebar animated fadeInUp">
                <div class="">
                  <a href="./contact-us.php"><img src="../assets/img/icons/facebook.svg" class="social-icon social"></a>
                </div>
                <div class="">
                  <a href="./contact-us.php"><img src="../assets/img/icons/gmail.svg" class="social-icon social"></a>
                </div> 
                <div class="">
                  <a href="./contact-us.php"><img src="../assets/img/icons/twitter.svg" class="social-icon social"></a>
                </div> 
              </div>
            </div>
            <div class ="container header-content">
              <div class="row">
                  <div class="col-md-4 " ></div>
                  <div class="col-md-4" >
                      <div class="header-frame">
                         <center><a href="#"><img src="../assets/img/logo.png"  class="img-responsive animated fadeInRight" alt=""> </a></center>
                      </div>
                      <center>
                  <h3 class="animated fadeInRight">Granting Relief in Times of Grief</h3>
                </center>
                  </div>
                  <div class="col-md-4" ></div>
                </div>
              </div>
            </div>
        </div>
         <nav class="navbar navbar-default">
          <div class="container" style="position: relative">
          <div class="navbar-header" >
            <button type="button"  class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand custom-brand" id="nav-bar" href="#" style="" align="center">Garden Of Paradise FH</a>
            <a class="navbar-brand" id="nav-bar" href="#" align="center">Garden Of Paradise FH</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="./home.php" class="<?= ($title =="Home")?'nav-active':''?>">Home</a></li>
              <li><a href="./obituary.php" class="<?= ($title =="Obituary")?'nav-active':''?>">Obituary</a></li>
              <li><a href="./dedication.php" class="<?= ($title =="Dedication")?'nav-active':''?>">Dedication</a></li>
              <li><a href="./album.php" class="<?= ($title =="Gallery" || $title =="Albums")?'nav-active':''?>">Gallery</a></li>
              <li><a href="./about-us.php" class="<?= ($title =="About Us")?'nav-active':''?>">About Us</a></li>
               <li><a href="./services.php" class="<?= ($title =="Services")?'nav-active':''?>">Services</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Packages<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="./basicpackages.php" class="<?= ($title =="Basic Package")?'nav-active':''?>">Basic Packages</a></li>
                  <li><a href="./gardenpackages.php" class="<?= ($title =="Garden Package")?'nav-active':''?>">Garden Packages</a></li>
                  <li><a href="./paradisepackages.php" class="<?= ($title =="Paradise Package")?'nav-active':''?>">Paradise Packages</a></li>
                  <li><a href="./customize-package.php" class="<?= ($title =="Customize Package")?'nav-active':''?>">Customize Package</a></li>
                  <li><a href="./prearrangements.php" class="<?= ($title =="Pre-Arrangements")?'nav-active':''?>">Pre-Arrangements</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="./contact-us.php" class="<?= ($title =="Contact Us")?'nav-active':''?>">Contact Us</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    <div class="back-to-top">
      <a href="#" class="symbol"><span class="glyphicon glyphicon-chevron-up"></span></a>
    </div>
    <img src="../assets/img/logo.png" class ="watermark" alt="garden_of_paradise_logo">