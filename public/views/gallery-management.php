<?php require_once('header.php'); ?> 
<script type="text/javascript" src="../assets/lib/plupload/plupload.min.js"></script>

<div class="container">
    <form>
        <div class="form-group">
            <label for="albumInput">Album</label>
            <input type="text" class="form-control" id="albumInput" placeholder="Album Name">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
<div id="uploader">
    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
</div>
 
<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : "/examples/upload",
 
        // Maximum file size
        max_file_size : '2mb',
 
        chunk_size: '1mb',
 
        // Resize images on clientside if we can
        resize : {
            width : 200,
            height : 200,
            quality : 90,
            crop: true // crop to exact dimensions
        },
 
        // Specify what files to browse for
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
        ],
 
        // Rename files by clicking on their titles
        rename: true,
         
        // Sort files
        sortable: true,
 
        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,
 
        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
 
        // Flash settings
        flash_swf_url : '/plupload/js/Moxie.swf',
     
        // Silverlight settings
        silverlight_xap_url : '/plupload/js/Moxie.xap'
    });
});
</script>
<?php require_once('footer.php'); ?>