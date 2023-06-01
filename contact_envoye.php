<?php
include('config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


    // Récupérer les données du formulaire
    if(isset($_POST['envoyer'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $tel = $_POST['telephone'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $recipient = 'contaoussama17@gmail.com';
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
            $mail->addAddress($recipient);   //Add a recipient
            
            //Content
            $mail->isHTML(true);          //Set email format to HTML
            $subject = '';
            $mail->Subject = $subject;
            $mail->Body    = $message ;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo '
            <script>
                alert("Message has been sent");
            </script>
            ';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } catch (Exception $e) {
            echo "
            <script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo};');
            </script>
            ";
        }
    }
}