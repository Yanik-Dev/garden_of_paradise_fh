
<?php $title = "Contact Us";?>
<?php require_once('header.php'); ?>   
<body>
    <div class="container contact-container">
    <div class="container">    
    <div class="row info-content animated lightSpeedIn">    
        <div class="col-md-4 col-sm-4 col-xs-12" >
        <center>
            <img src="../assets/img/icons/email-contact.png"  alt="Email">
            <h4>gardenofparadisefh@gmail.com</h4>
            </center>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12 ">
            <center>
                <img src="../assets/img/icons/telephone-contact.png"   alt="Phone">
               <h4>(1-876) 327-9729</h4>
                <h4>(1-876) 870-5848</h4> 
            </center>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12 animated zoomIn">
            <center>
                <img src="../assets/img/icons/location-contact.png" alt="Location">
                <h4>1 North Avenue, Kingston 5</h4>
                <h4>Jamaica</h4>
            </center>
        </div>
    </div>
    </div>
    <div class="contact-us-2 container">

        <h1>CONTACT US TODAY</h1>
        <div class="line"></div>
        <form action="../actions/contact-us-action.php" method="post">
        <div class="contact-send">
             <?php 
                  if(isset($_GET["error"])){
                       echo ' <div class="alert alert-success  alert-dismissible" role="alert"  id="error-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                            ';
                      if($_GET["error"] == 1){
                        echo"There was an error sending your email";
                      }
                      if(isset($_GET["error-name"])){
                        echo"Your name is required";
                      }
                      if(isset($_GET["error-email"])){
                        echo"A valid email is required";
                      }
                      if(isset($_GET["error-message"])){
                        echo"A message is required";
                      }
                      echo '</div>';
                  }
                  if(isset($_GET["success"])){
                        echo ' <div class="alert alert-success  alert-dismissible" role="alert"  id="error-alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
                                    Thank you for making Garden of Paradise Funeral Home your choice. We will respond to you within 24 hours.
                            </div>';
                    }
                ?>
            <p class="success"><?=(isset($_GET["success"]))?"Your message has been sent successfully!":""?><p>
            <input type="text" name="name"  class="form-control" placeholder="Name *" colspan="4" required maxlength="15" />
            <input type="email" name="email"  class="form-control" placeholder="Email *" required />
            <input type="text" name="subject"  class="form-control" placeholder="Subject"/>
            <textarea rows="6" cols="" name="message" placeholder="Message" class="form-control" require></textarea>
        <button class="button" type="submit">Send Message</button>
            
        </form>

     </div>
    </div>
    </div>

     <div class="container-fiuld">
        <div class="map">
        <img src="../assets/img/Map.png">
        </div>
     </div>

<?php require_once('footer.php'); ?>