<?php
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';          //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                          //Enable SMTP authentication
    $mail->Username   = 'contaoussama17@gmail.com';      //SMTP username
    $mail->Password   = 'hbrrnzjwanqjorto';            //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
    $mail->Port       = 465;                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'BaytiShop');
    $mail->addAddress($email);   //Add a recipient
    
    //Content
    $mail->isHTML(true);          //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message ;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '
    <script>
    alert("Message has been sent");
    </script>
    ';
    include('acceuil.php');
} catch (Exception $e) {
    echo "
    <script>
    alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo};');
    </script>
    ";
}