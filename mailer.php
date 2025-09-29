<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

// Create the logger
$log = new Logger('complaint_logger');

// Create a handler: log everything from DEBUG and up
$log->pushHandler(new StreamHandler(__DIR__ . '/logs/complaints.log', "debug"));

// Example log messages
$log->info('Complaint form loaded');
$log->warning('User submitted an empty complaint');
$log->error('Failed to save complaint to database');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['naam']);
    $email = htmlspecialchars($_POST['email']);
    $omschrijving = htmlspecialchars($_POST['omschrijving']);
  if (empty($name)) {
    echo "Name is niet ingevuld";
  }
  elseif(empty($email)) {
    echo "Email is niet ingevuld";
  }
  elseif(empty($omschrijving)){
    echo "Omschrijving is niet ingevuld";
  }
}

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nysschool123@gmail.com';               //SMTP username
    $mail->Password   = 'sqyz wjsq vevu dwpw ';                 //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress($email, $name);     //Add a recipient
    $mail->addCC("40204747@yonder.nl");

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Uw klacht is in behandeling';
    $mail->Body    = "<p><strong>Omschrijving:</strong><br>$omschrijving</p>";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}