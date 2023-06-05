<?php
include('config.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['telephone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $recipient = $_POST['recipient'];


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
        $mail->setFrom($email, 'BaytiShop');
        $mail->addAddress('contaoussama@gmail.com');   //Add your email address as the recipient
        
        //Content
        $mail->isHTML(true);          //Set email format to HTML
        $subject = 'Message de '.$nom.' '.$prenom;
        $mail->Subject = $subject;
        $mail->Body = "Nom: $nom<br>
                       Prénom: $prenom<br>
                       Email: $email<br>
                       Téléphone: $tel<br>
                       Message: $message";
        $mail->AltBody = "Nom: $nom\n
                          Prénom: $prenom\n
                          Email: $email\n
                          Téléphone: $tel\n
                          Message: $message";
        
        $mail->send();
        echo '<script>alert("Message has been sent");</script>';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } catch (Exception $e) {
        echo '<script>alert("Message could not be sent. Mailer Error: '.$mail->ErrorInfo.'");</script>';
    }
}
?>
