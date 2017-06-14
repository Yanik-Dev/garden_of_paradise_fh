
<?php $title = "Contact Us";?>
<?php require_once('header.php'); ?>   
<body>
    <div class="container contact-container">
    <div class="row info-content">    
        <div class="col-md-4 col-sm-4 col-xs-12">
        <center>
            <img src="../assets/img/icons/email-contact.png" alt="Email">
            <p>gardenofparadisefh@gmail.com</p>
            </center>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <center>
                <img src="../assets/img/icons/telephone-contact.png" alt="Phone">
                <p>(1-876) 327-9729</p>
                <p>(1-876) 870-5848</p>
            </center>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <center>
                <img src="../assets/img/icons/location-contact.png" alt="Location">
                <p>1 North Avenue, Kingston 5</p>
                <p>Jamaica</p>
            </center>
        </div>
    </div>
    <div class="contact-us-2">

        <h1>CONTACT US TODAY</h1>
        <div class="line"></div>
        <form action="../actions/contact-us-action.php" method="post">
        <div class="contact-send">
             <?php 
                  if(isset($_GET["error"])){
                      if($_GET["error"] == 1){
                        echo"<p class='error'>*There was an error sending your email</p>";
                      }
                      if(isset($_GET["error-name"])){
                        echo"<p class='error'>*Your name is required</p>";
                      }
                      if(isset($_GET["error-email"])){
                        echo"<p class='error'>*A valid email is required</p>";
                      }
                      if(isset($_GET["error-message"])){
                        echo"<p class='error'>*A message is required</p>";
                      }
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