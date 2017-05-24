
<?php $title = "Contact Us";?>
<?php require_once('header.php'); ?>   
<body>
    <div class="container contact-container">
    <div class="row info-content">    
        <div class="col-md-4 col-sm-4 col-xs-12">
        <center>
            <img src="../assets/img/icons/email-contact.png" alt="Email">
            <p>gardenofparadisefh@gmail.com</p>
            <p>www.gardenofparadisefh.com</p>
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

        <div class="contact-send">

            <input type="text" name="Name"  class="form-control" placeholder="Name *" colspan="4" required />
            <input type="email" name="Email"  class="form-control" placeholder="Email *" required />
            <input type="text" name="Subject"  class="form-control" placeholder="Subject"/>
            <textarea rows="6" cols="" placeholder="Message" class="form-control"></textarea>

        <button class="button" type="button">Send Message</button>

     </div>
    </div>
    </div>

     <div class="container-fiuld">
        <div class="map">
        <img src="../assets/img/Map.png">
        </div>
     </div>

<?php require_once('footer.php'); ?>