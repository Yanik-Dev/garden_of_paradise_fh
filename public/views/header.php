<!doctype html>
<html>
    <head> 
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Garden Of Paradise - <?=$title?> </title>
      <link rel="stylesheet" type="Text/css" href="../css/style.css">
      <link rel="stylesheet" type="Text/css" href="../lib/bootstrap/css/bootstrap.min.css">
    </head>
    <body>
    <div class="header">
        <div class="container-fluid social-bar">
            <div class ="container ">
                <a href="#"><img src="../img/icons/gmail.svg" class="social-icon" alt=""> </a>
                <a href="#"><img src="../img/icons/facebook.svg" class="social-icon" alt=""> </a>
                <a href="#"><img src="../img/icons/twitter.svg" class="social-icon" alt=""></a>
                <a href="#"><img src="../img/icons/youtube.svg" class="social-icon" alt=""></a>
                <a href="#" id="location"> 
                </a>
            </div>
            </div>
          
        <div class="container-fluid">
            <div class ="container header-content">
              <div class="row">
                <div class="col-md-6 col-sm-6 ">
                     <a href="#"><img src="../img/logo.png"  alt=""> </a>
                 </div>
                 <div class="col-md-6 col-sm-6">
                   <div class="header-content-right">
                     <img style="border: 5px solid #E0E0E0"src="../img/phone.jpg" width="50px" height="50px" class="" alt="" align="left">              
                    <h5>(876) 899 0098 </h5>
                   </div>
                 </div>
              </div>
            </div>
        </div>
         <nav class="navbar navbar-default">
          <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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
              <li><a href="./obituary.php" class="<?= ($title =="Obitutary")?'nav-active':''?>">Obituary</a></li>
              <li><a href="#" class="<?= ($title =="About Us")?'nav-active':''?>">About Us</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Pre-Funeral Arrangments</a></li>
                  <li><a href="#">Exquisite Funeral Arrangments</a></li>
                  <li><a href="#">Grief Counselling</a></li>
                  <li><a href="#">Cremation</a></li>
                  <li><a href="#">Death Announcements</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    </div>
    <div class="back-to-top">
      <a href="#">Back to top</a>
    </div>