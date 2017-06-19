<?php
    
 require_once('../services/AlbumService.php');
 require_once('../services/TestimonyService.php');
 
    $testimonyService = new TestimonyService();
    $testimonyList = $testimonyService->get(1, 1);
    $albumService = new AlbumService();
    $albumList = $albumService->getAlbumbyLimit(1, 6);

?>

      <div class="contianer-fiuld footer">
        <div class="container">
            <div class="row">
            <div class="col-md-3">
                <center><h1><img src="../assets/img/logo.png" width="150px" height="150px" class="img-responsive" alt="Garden of Paradise Logo"></h1></center>
                <p>
                Our professional and caring staff is dedicated to working with your 
                family to provide assistance in selecting high quality and affordable 
                funeral services during a time
                </p>
            </div>
            <div class="col-md-3">
                <h2>Testimonals</h2>
                 <?php if(count($testimonyList) > 0): ?>
                <blockquote>
                    <p>"<?=$testimonyList[0]->getComment();?>"</p>
                   <footer><cite title="Source Title"><?=$testimonyList[0]->getName();?></cite></footer>
                </blockquote>
                <a href="testimonals.php">View All Testimonals</a>
               
               <?php else: ?>
                    <br />
                    <br />
                    <center><h5>No Testimonals Available </h5></center>
                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <h2>Contact Info</h2>
                <p>1 North Avenue</p>
                <p> Kingston 5, Jamaica</p>
                <p>(1-876) 327-9729</p>
                <p>(1-876) 870-5848</p>
                <p>gardenofparadisefh@gmail.com</p>
            </div>
            <div class="col-md-3">
                <h2>Photo Gallery</h2>
                <?php if(count($albumList) > 0): ?>
                <div class="row">
                    <div class="col-md-12">
                     <?php $i = 0; foreach($albumList as $album) :?>
                        <a href="<?='gallery.php?id='.$album->getId()?>" style="text-decoration: none;"> 
                            <img  src="<?= ($album->getImages() != null)?'..\\uploads\\'.$album->getImages()[0]->getPath():'../assets/img/placeholder.png' ?>" class="photo ">
                        </a>
                     <?php endforeach; ?>
                    </div>
                </div>
                <a href="album.php">View More Photos</a>
                <?php else: ?>
                    <center><h5>No Photos </h6></center>
                <?php endif; ?>
            </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container ">
                <p>Nik&Div© 2017 All Rights Reserved Terms of Use and Privacy Policy</p>
            </div>
            </div>
        </div>   
       <script type="text/JavaScript" src="../assets/lib/jquery/jquery-3.2.1.min.js"></script>
       <script type="text/JavaScript" src="../assets/lib/bootstrap/js/bootstrap.min.js"></script>
       <script src="../assets/lib/wow.min.js"></script>
        <script>
            wow = new WOW(
            {
                animateClass: 'animated',
                offset:       100,
                callback:     function(box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                }
            }
            );
            wow.init();
        </script>
    </body>
</html>
