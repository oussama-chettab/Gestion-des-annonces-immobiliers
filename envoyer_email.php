<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $agenceId = $_POST['agenceId'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = 'From: BaytiShop.com <br>Nom user: '.$nom.'<br>Email user: '.$email.'<br><strong>Message:</strong> '.$_POST['message'];
    $subject = 'Contacter Agence immobiliere';
    
    // Récupérer l'adresse e-mail de l'agence à partir de la base de données
    include('config.php');
    $query = "SELECT email FROM agence WHERE Id_Ag = '$agenceId'";
    $result = mysqli_query($conn, $query);
    $agence = mysqli_fetch_assoc($result);

    if ($agence) {
        $adresseEmailAgence = $agence['email'];
        
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
            $mail->setFrom($email, $nom);
            $mail->addAddress('contaoussama17@gmail.com');   //Add a recipient
            
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
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            } catch (Exception $e) {
            echo "
            <script>
            alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo};');
            </script>
            ";
        }
    } else {
        echo '<h2>Agence introuvable</h2>';
    }
}
?>