<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $agenceId = $_POST['agenceId'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Récupérer l'adresse e-mail de l'agence à partir de la base de données
    include('config.php');
    $query = "SELECT email FROM agence WHERE Id_Ag = '$agenceId'";
    $result = mysqli_query($conn, $query);
    $agence = mysqli_fetch_assoc($result);

    if ($agence) {
        $adresseEmailAgence = $agence['email'];
        
        ini_set('SMTP', 'smtp.gmail.com');
        ini_set('smtp_port', 587);
        ini_set('sendmail_from', 'contaoussama17@gmail.com');
        ini_set('sendmail_path', 'C:\xampp\sendmail\sendmail.exe -t');
        // Envoyer l'e-mail
        $sujet = "Nouveau message de la part de $nom";
        $corps = "Nom: $nom\n";
        $corps .= "Email: $email\n";
        $corps .= "Message: $message\n";
        
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        
        if (mail($adresseEmailAgence, $sujet, $corps, $headers)) {
            echo '<h2>Message envoyé avec succès!</h2>';
        } else {
            echo '<h2>Erreur lors de l\'envoi du message.</h2>';
        }
    } else {
        echo '<h2>Agence introuvable</h2>';
    }
}
?>