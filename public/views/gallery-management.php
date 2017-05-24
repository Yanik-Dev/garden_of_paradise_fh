<?php
 session_start();
 $title = "Gallery Management"
?>
<?php require_once('header.php'); ?> 
<div class="container gallery-management">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
            <form class="form-inline">
                <div class="col-sm-10"> 
                     <input type="text" class="form-control" name="search" placeholder="Search">
                </div>
                
                <div class="col-sm-2"> 
                <button type="submit" class="">Go</button>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Album Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>

                        <td>John</td>
                    </tr>
                </tbody>
            </table>
            <form class="form-inline">
                  <div class="col-sm-10"> 
                     <input type="text" class="form-control" name="albumName" placeholder="Album">
                </div>
                
                <div class="col-sm-2"> 
                <button type="submit" class="">Add</button>
            </form>
            </div>
        </div>
        <div class="col-md-5"> 
            <div class="card">
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once('footer.php'); ?>