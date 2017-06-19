<?php
require_once "../vendor/Mail/Mail.php";
require('../services/ItemService.php');
require('../services/CategoryService.php'); 
include_once("../config/Config.php");
global $_CONFIG;

 $itemService = new ItemService();
 $categoryService = new CategoryService();

 $categories = $categoryService->get(1,10);



if(strcmp($_POST['name'], "") == 0){
    header("location: ../views/customize-package.php?error=2");
    exit;
}
if(isset($_POST['email'])){
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header("location: ../views/customize-package.php?error=4");
        exit;
    }
}
if(!isset($_POST['tel'])){
    header("location: ../views/customize-package.php?error=3");
    exit;
}

$packageDetails ="<ul>";
$i=0;
foreach($categories as $category){
    $items = $category->getItems();
    foreach($items as $item){
        $name = $item->getId();
        if(isset($_POST[$name])){
           $packageDetails .='<li>'.$_POST[$name].'</li>';
           $i++;
        }
    }
}
$packageDetails .="</ul>";

if($i == 0){
    header("location: ../views/customize-package.php?error=6");
    exit;
}

$subject = "Quotation Request - Customized Package";
$body ="<h3>Requested By: </h3>"
       ."<p>".$_POST['name']."</p>"
       ."<p>".$_POST['tel'].((isset($_POST['email']))?" | ".$_POST['email']."</p>":"</p>")
       .((isset($_POST['message']))?"<h4> Additional Request </h4> <p>".$_POST['message']."</p>":"")
       ."<h4>Details</h4> <p>{$title}</p>".$packageDetails;

$headers = array(
    'From' =>  $_CONFIG["EMAILCRED"]["USERNAME"],
    'To' =>  $_CONFIG["EMAILCRED"]["TO"],
    'Subject' => $subject,
    'MIME-Version' => 1,
    'Content-type' => 'text/html;charset=iso-8859-1'
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' =>  $_CONFIG["EMAILCRED"]["USERNAME"],
        'password' =>  $_CONFIG["EMAILCRED"]["PASSWORD"]
));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
   header("location: ../views/contact-us.php?error=1");
   exit;
} else {
    header("location: ../views/contact-us.php?success=true");
    exit;
}