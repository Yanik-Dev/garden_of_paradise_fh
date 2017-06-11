<?php
require_once "../vendor/Mail/Mail.php";

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

$from = '<'.$_POST['email'].'>';
$to = '<yanikblake@yahoo.com>';
$subject = $_POST['subject'];
$body = $_POST['message']."\r\n\n"."<b>From:</b> <br />".$_POST['name']."<br /><i>(".$_POST['email'].")</i>";

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject,
    'MIME-Version' => 1,
    'Content-type' => 'text/html;charset=iso-8859-1'
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'yanikblake@gmail.com',
        'password' => 'N@ruto123',
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