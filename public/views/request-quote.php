
<?php $title = "Request Quote";?>
<?php require_once('header.php'); ?>  

<?php
if(!isset($_GET['type']) ){
  header('Location: ./home.php');
  exit;
}

$title = 'Basic Package';
$items = [];
if($_GET['type'] =='bp'){
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","100 Programs","100 Prayer Cards/Book Markers",
        "TVJ's Death Announcement",
    ];
}
else if($_GET['type'] =='bpp'){
    $title = 'Basic Personal';
    $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","SingleVault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement",
    ];
}
else if($_GET['type'] =='bpd'){
     $title = 'Basic Package - Deluxe';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Vault 1/2 Double (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons"
    ];
}

else if($_GET['type'] =='bpdp'){
     $title = 'Basic Package - Deluxe Personal';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons"
    ];
}
else if($_GET['type'] =='bps'){
     $title = 'Basic Package - Super';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons", "Bands for Set UP"
    ];
}

else if($_GET['type'] =='gp'){
    $title = 'Garden Package';
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Regular or Semi-customized Casket","Casket Spray","Hearse","150 Programs","150 Prayer Cards/Book Markers",
        "Two (2) TVJ's Death Announcement + One (1) Gleaner Advertisement",
    ];
}
else if($_GET['type'] =='gpp'){
    $title = 'Garden Package - Personal';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement"
    ];
}
else if($_GET['type'] =='gpd'){
    $title = 'Garden Package - Deluxe';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Vault 1/2 Double (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement"
    ];
}
else if($_GET['type'] =='gpdp'){
    $title = 'Garden Package - Deluxe Pesonal';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement", "JUTC Bus & 100 Buttons"
    ]; 
}
else if($_GET['type'] =='gps'){   
    $title = 'Garden Package - Super';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement", "JUTC Bus & 100 Buttons", "Bands for Set UP"
    ];
}       
else if($_GET['type'] =='pp'){
    $title = 'Paradise Package';
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Regular or Semi-customized Casket","Casket Spray","Hearse","Wreath", "200 Programs","200 Prayer Cards/Book Markers",
        "Two (2) TVJ's Death Announcement + One (1) Gleaner Advertisement",
    ];
} 
else if($_GET['type'] =='ppd'){ 
     $title = 'Paradise Package - Deluxe';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Regular or Semi-Customized Casket","Casket Spray", "Wreath + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "200 Programs", "200 Prayer Cards or Book Markers", "100 Buttons",
        "2 TVJ's Death Announcement", "1 Gleaner Advertisment + 1 JUTC Bus", "Bands for Set UP"
    ];
}
else if($_GET['type'] =='pps'){
    $title = 'Paradise Package - Super';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Regular or Semi-Customized Casket","Casket Spray", "Wreath + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "200 Programs", "200 Prayer Cards or Book Markers", "100 Buttons",
        "2 TVJ's Death Announcement", "1 Gleaner Advertisment + 1 JUTC Bus", "Bands for Set UP"
    ];
}
else{
    header('Location: ./home.php');
    exit;
}
?> 
<body>
  <div class="contact-container">
      <div class="container">
    <div class="contact-us-2">
        <div class="row">
            <div class="col-md-6">
                <h1>Request Quotation</h1>
                <div class="line"></div>
                <form action="../actions/request-quote-action.php" method="post">
                <div class="request">
                    <?php 
                        if(isset($_GET["error"])){
                            if($_GET["error"] == 1){
                                echo'
                                <div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                        There was an error sending your quote
                                </div>';
                            }
                        }
                            if(isset($_GET["error-name"])){
                                echo'<div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                        Your name is required
                                    </div>';
                            }
                            if(isset($_GET["error-email"])){
                                echo'<div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                       A valid email is required
                                     </div>';
                            }                            
                            if(isset($_GET["error-tel"])){
                                echo'<div class="alert alert-danger  alert-dismissible" role="alert"  id="error-alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                       A valid phone number is required
                                     </div>';
                            }
                        if(isset($_GET["success"])){
                            echo ' <div class="alert alert-success  alert-dismissible" role="alert"  id="error-alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                        Thank you for making Garden of Paradise Funeral Home your choice. We will respond to you within 24 hours.
                                    </div>';
                        }
                    ?>
                    <p class="success"><?=(isset($_GET["success"]))?"Your message has been sent successfully!":""?><p>
                    <input type="hidden" name="type" value="<?=$_GET['type']?>">
                    <div class="form-group">
                     <input type="text" name="name"  class="form-control" placeholder="Name *" colspan="4" required maxlength="15" />
                    </div>
                    <div class="form-group">
                     <input type="email" name="email"  class="form-control" placeholder="Email"  />
                     </div>
                    <div class="form-group">
                      <input type="tel" name="tel"  class="form-control" placeholder="Phone Number *" pattern="/^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i" required />
                      <small>Expected Formats: 000-0000 or 000 000 0000</small>
                    </div>
                    <div class="form-group">
                    <textarea rows="6" cols="" name="message" placeholder="Additional requests" class="form-control" ></textarea>
                    </div>
                    <center> <button class="button" type="submit">Send Request</button></center>
                </div>
            </form>
        </div>
       
        <div class="col-md-6">
            <br />
            <br />
            <br />
            <br />
            <br />
            <h3>Selected Package: </h3> <p><?= $title?> </p>
            <ul>
                <?php foreach($items as $item): ?>
                   <li><?= $item ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
       </div>
    </div>
    </div>
</div>
</br>
</br>


<?php require_once('footer.php'); ?>