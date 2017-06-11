
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
else if($_GET['type'] =='gp'){
$title = 'Garden Package';
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Regular or Semi-customized Casket","Casket Spray","Hearse","150 Programs","150 Prayer Cards/Book Markers",
        "Two (2) TVJ's Death Announcement + One (1) Gleaner Advertisement",
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
else{
    header('Location: ./home.php');
    exit;
}
?> 
<body>
  <div class="container contact-container">
    <div class="contact-us-2">
        <div class="row">
            <div class="col-md-6">
                <h1>Request Quotation</h1>
                <div class="line"></div>
                <form action="../actions/contact-us-action.php" method="post">
                <div class="request">
                    <?php 
                        if(isset($_GET["error"])){
                            if($_GET["error"] == 1){
                                echo"<p class='error'>*There was an error sending your quote</p>";
                            }
                            if(isset($_GET["error-name"])){
                                echo"<p class='error'>*Your name is required</p>";
                            }
                            if(isset($_GET["error-num"])){
                                echo"<p class='error'>*A valid phone number is required</p>";
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
                    <div class="form-group">
                     <input type="text" name="name"  class="form-control" placeholder="Name *" colspan="4" required maxlength="15" />
                    </div>
                    <div class="form-group">
                     <input type="email" name="email"  class="form-control" placeholder="Email *"  />
                     </div>
                    <div class="form-group">
                      <input type="tel" name="tel"  class="form-control" placeholder="(000) 000-0000 *" required pattern="" />
                    </div>
                    <div class="form-group">
                    <textarea rows="6" cols="" name="message" placeholder="additional requests" class="form-control" ></textarea>
                    </div>
                    <center> <button class="button" type="submit">Send Request</button></center>
                </form>
            </div>
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
</br>
</br>


<?php require_once('footer.php'); ?>