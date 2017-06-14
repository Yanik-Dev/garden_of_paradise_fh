<?php
require_once "../vendor/Mail/Mail.php";
include_once("../config/Config.php");
global $_CONFIG;

if(strcmp($_POST['name'], "") == 0){
    header("location: ../views/contact-us.php?error-name=1");
    exit;
}
if(strcmp($_POST['message'], "") == 0){
    header("location: ../views/contact-us.php?error-message=1");
    exit;
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  header("location: ../views/contact-us.php?error-email=1");
    exit;
}
$to = $_CONFIG["EMAILCRED"]["TO"];
$subject = $_POST['subject'];
$body = $_POST['message']."<br />"."<b>From:</b> <p>".$_POST['name']."</p> <i>(".$_POST['email'].")</i>";

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