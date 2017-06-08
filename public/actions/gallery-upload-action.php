<?php
require('../services/ImageService.php');

$i=count($_FILES['files']['tmp_name']);


ImageService::insert($_FILES['files'], $_POST['album']);