<?php
require_once "../vendor/Mail/Mail.php";
include_once("../config/Config.php");
global $_CONFIG;
       
if(!isset($_POST['type']) ){
  header('Location: ../views/home.php');
  exit;
}

$title = 'Basic Package';
$items = [];
if($_POST['type'] =='bp'){
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","100 Programs","100 Prayer Cards/Book Markers",
        "TVJ's Death Announcement",
    ];
}
else if($_POST['type'] =='bpp'){

    $title = 'Basic Personal';
    $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","SingleVault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement",
    ];
}
else if($_POST['type'] =='bpd'){
     $title = 'Basic Package - Deluxe';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Vault 1/2 Double (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons"
    ];
}
else if($_POST['type'] =='bpdp'){
     $title = 'Basic Package - Deluxe Personal';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons"
    ];
}
else if($_POST['type'] =='bps'){
     $title = 'Basic Package - Super';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "100 Programs", "100 Prayer Cards or Book Markers",
        "1 TVJ's Death Announcement", "JUTC Bus & 50 Buttons", "Bands for Set UP"
    ];
}
else if(strcmp($_POST['type'],'gp') == 0){
    $title = 'Garden Package';
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Regular or Semi-customized Casket","Casket Spray","Hearse","150 Programs","150 Prayer Cards/Book Markers",
        "Two (2) TVJ's Death Announcement + One (1) Gleaner Advertisement",
    ];
}
else if($_POST['type'] =='gpp'){
    $title = 'Garden Package - Personal';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement"
    ];
}
else if($_POST['type'] =='gpd'){
    $title = 'Garden Package - Deluxe';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Vault 1/2 Double (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement"
    ];
}
else if($_POST['type'] =='gpdp'){

    $title = 'Garden Package - Deluxe Pesonal';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement", "JUTC Bus & 100 Buttons"
    ]; 
}
else if($_POST['type'] =='gps'){   
    $title = 'Garden Package - Super';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Casket","Casket Spray + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "150 Programs", "150 Prayer Cards or Book Markers",
        "2 TVJ's Death Announcement", "JUTC Bus & 100 Buttons", "Bands for Set UP"
    ];
}       
else if($_POST['type'] =='pp'){
    $title = 'Paradise Package';
    $items = [
        "Pick Up", "Storage","Embalm & Preparation",
        "Regular or Semi-customized Casket","Casket Spray","Hearse","Wreath", "200 Programs","200 Prayer Cards/Book Markers",
        "Two (2) TVJ's Death Announcement + One (1) Gleaner Advertisement",
    ];
} 
else if(strcmp($_POST['type'], 'ppd')== 0){ 
     $title = 'Paradise Package - Deluxe';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Regular or Semi-Customized Casket","Casket Spray", "Wreath + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "200 Programs", "2000 Prayer Cards or Book Markers", "100 Buttons",
        "2 TVJ's Death Announcement", "JUTC Bus &1 Gleaner Advertisment + 1 JUTC Bus", "Bands for Set UP"
    ];
}
else if(strcmp($_POST['type'], 'pps')==0){
    $title = 'Paradise Package - Super';
     $items = [
        "Pick Up", "2 Weeks Storage","Embalm & Preparation",
        "Regular or Semi-Customized Casket","Casket Spray", "Wreath + Arrangement","Hearse","Single Vault (Dovecot or Meadowrest)", 
        "200 Programs", "2000 Prayer Cards or Book Markers", "100 Buttons",
        "2 TVJ's Death Announcement", "JUTC Bus &1 Gleaner Advertisment + 1 JUTC Bus", "Bands for Set UP"
    ];
}
else{
    header('Location: ../views/home.php');
    exit;
}

if(strcmp($_POST['name'], "") == 0){
    header("location: ../views/request-quote.php?error-name=1&type=".$_POST['type']);
    exit;
}
if(isset($_POST['email'])){
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header("location: ../views/request-quote.php?error-email=1&type=".$_POST['type']);
        exit;
    }
}
if(!isset($_POST['tel'])){
    header("location: ../views/request-quote.php?error-tel=1&type=".$_POST['type']);
    exit;
}
$packageDetails ="<ul>";
foreach($items as $item){
    $packageDetails .='<li>'.$item.'</li>';
}
$packageDetails .="</ul>";

$to =$_CONFIG["EMAILCRED"]["TO"];
$subject = "Quotation Request - ".$title;
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
   header("location: ../views/request-quote.php?error=1&type=".$_POST['type']);
   exit;
} else {
    header("location: ../views/request-quote.php?success=true&type=".$_POST['type']);
    exit;
}