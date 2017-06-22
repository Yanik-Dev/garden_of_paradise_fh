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
        <div class="container-fluid social-bar  img-bg" style="padding: 0">
            <div class="container white-bg o-header"></div>
            <div class ="container k" >
                <div class="animated fadeInDown header-icons">
                  <a href="./services.php"><img src="../assets/img/icons/24hours.svg"  class="social-icon social-no-border" alt=""> </a>
                  <a href="./obituary.php"><img src="../assets/img/icons/paper.svg" class="social-icon social-no-border" alt=""></a>
                </div>
                <div id="location" style="float: right;" >
                  <a href="./contact-us.php" class="animated lightSpeedIn" id="" style="padding-top: 5px;color: #830506; font-weight: bold;text-decoration: none"> 
                  (1-876) 327-9729 | (1-876) 870-5848 
                </a>
                </div>
                
            </div>
        </div>
        <div class="container-fluid img-bg">
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="social-sidebar animated fadeInUp">
                <div class="">
                  <a href="https://www.facebook.com/GardenofParadisefh"><img src="../assets/img/icons/facebook.svg" class="social-icon social" style=""></a>
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
                         <center><img src="../assets/img/logo.png"  class="img-responsive animated fadeInRight" alt=""></center>
                      </div>
                      <center>
                  <h3 class="animated fadeInRight" style="color: #fff" >Granting Relief in Times of Grief</h3>
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
            <a class="navbar-brand" id="nav-bar" href="#" style="" align="center">Garden Of Paradise FH</a>
            <a class="navbar-brand"  href="#" align="center">Garden Of Paradise FH</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="./home.php" class="<?= ($title =="Home")?'nav-active':''?>">Home</a></li>
              <li><a href="./obituary.php" class="<?= ($title =="Obituary")?'nav-active':''?>">Obituary</a></li>
              <li><a href="./dedication.php" class="<?= ($title =="Dedication")?'nav-active':''?>">Dedication</a></li>
              <li><a href="./album.php" class="<?= ($title =="Gallery" || $title =="Albums")?'nav-active':''?>">Gallery</a></li>
              <li><a href="./about-us.php" class="<?= ($title =="About Us")?'nav-active':''?>">About Us</a></li>
               <li><a href="./services.php" class="<?= ($title =="Services")?'nav-active':''?>">Services</a></li>
              <li class="dropdown" id="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Packages<span class="caret"></span></a>
                <ul class="dropdown-menu" id="drop-menu">
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
    <img src="../assets/img/leaf_flip.png" class="img-responsive card-leaf-bottom-left"  width="90px" height="140px" style="position: fixed" alt="" > 
    <img src="../assets/img/leaf.png" class="img-responsive card-leaf-right"  width="100px" height="150px" alt="" style="position: fixed"> 
		
    <img src="../assets/img/logo.png" class ="watermark" alt="garden_of_paradise_logo">
<script type="text/javascript">// userAgent in FF35 Win7 returns: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0
// Get IE or Edge browser version


var version = detectIE();
if (version === false) {
  var d = document.getElementById("nav-bar");
   d.className += " custom-brand";
} else if (version >= 12) {
  var d = document.getElementById("nav-bar");
   d.className += " custom-brand-edge";
} else if (version == 102){
  var d = document.getElementById("nav-bar");
   d.className += " custom-brand-edge";
}
else {
   var d = document.getElementById("nav-bar");
   d.className += " custom-brand-edge";
}

/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
  var ua = window.navigator.userAgent;

  // Test values; Uncomment to check result …

  // IE 10
  // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';
  
  // IE 11
  // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';
  
  // Edge 12 (Spartan)
  // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';
  
  // Edge 13
  // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var chrome = ua.indexOf('Chrome/');
  if (chrome > 0) {
    // Edge (IE 12+) => return version number
    return 102;
  }

  var msie = ua.indexOf('MSIE ');

  // other browser
  return false;
}

</script>