<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include('config.php');

if (isset($_POST['submit'])) {
    
    if (isset($_POST['type_annonce'])) {
        $type_annonce = $_POST['type_annonce'];
        if (!in_array($type_annonce, ['Location', 'Vente', 'Colocation', 'Location vacances'])) {
            $type_annonce_error = '<p id="error">Choisissez un type d\'annonce !</p>';
            $err_s = 1;
        }
    }

    if(isset($_POST['type_bien'])){
        $type_bien = stripcslashes($_POST['type_bien']); 
        if(!in_array($type_bien,['Appartement','Maison','Terrain','Bureau','Atelier','Chateau','Clinique','Ecole','Gymnase'])){
            $type_error = '<p id="error">choisez type de bien !</p>';
            $err_s = 1;
        }      
    }
    $titre = stripcslashes(strtolower($_POST['titre']));
    $adresse = $_POST['adresse'];
    $description = $_POST['description'];
    $prix = stripcslashes(strtolower($_POST['prix']));
    $valide = 0;
    $Id_U = $_SESSION['Id_U'];
    
    if(isset($_POST['ville'])){
        $ville = stripcslashes($_POST['ville']); 
        if(!in_array($ville,['Alger','Annaba','Constantine','Setif','Bejaia','Jijel','Oumbouaki','Taraf'])){
            $ville_error = '<p id="error">choisez ville slvp !</p>';
            $err_s = 1;
        }      
    }
    if(isset($_POST['chambre'])){
        $chambre = stripcslashes($_POST['chambre']); 
        if(!in_array($chambre,['chambre','2 chambres','3 chambres','4 chambres','5 chambres','6 chambres ou+'])){
            $chambre_error = '<p id="error">choisez nombre des chambres slvp !</p>';
            $err_s = 1;
        }      
    }
    if(isset($_POST['etage'])){
        $etage = stripcslashes($_POST['etage']); 
        if(!in_array($etage,['rez de chaussee','1 etage','2 etage','3 etage','4 etage','5 etage ou+'])){
            $etage_error = '<p id="error">choisez nombre etage slvp !</p>';
            $err_s = 1;
        }      
    }
    $surface = stripcslashes(strtolower($_POST['surface']));
    $meuble = isset($_POST['meublé']) ? 1 : 0;
    $electromenager = isset($_POST['electromenager']) ? 1 : 0;
    $jardin = isset($_POST['jardin']) ? 1 : 0;
    $piscine = isset($_POST['piscine']) ? 1 : 0;
    $garage = isset($_POST['garage']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $espace_exterieur = isset($_POST['espace_exterieure']) ? 1 : 0;
    
    $check_user = " SELECT * FROM annonce Where adresse='$adresse'; ";
    $check_result = mysqli_query($conn,$check_user);
    $num_rows = mysqli_num_rows($check_result);
if(!isset($err_s)){
    if($num_rows == 0){
        $photo = $_FILES['photo']['name'];
        $photo_size = $_FILES['photo']['size'];
        $photo_error = $_FILES['photo']['error'];
        $file = explode('.',$photo);
        $file_accept = strtolower(end($file));
        $allowed = array('png','jpg','svg','jpeg');
    
        if((in_array($file_accept,$allowed)) && ( $photo_size < 4000000 )){ 
            $photo_tmp_name = $_FILES['photo']['tmp_name'];
            $photo_data = file_get_contents($photo_tmp_name);
            $photo_base64 = base64_encode($photo_data);
            $target_directory = 'annonce_images/';
            $target_path = $target_directory . basename($photo);
            
            $sql = "INSERT INTO annonce (type_annonce, type_bien, titre, adresse, description, prix, ville, photo, chambres, etage, surface, Meublé, Electroménager, Jardin, Piscine, Garage, Parking, Espase_exterieure, valide, id_U)
            VALUES ('$type_annonce','$type_bien', '$titre', '$adresse', '$description','$prix', '$ville', '$target_path','$chambre','$etage','$surface','$meuble','$electromenager','$jardin','$piscine','$garage', '$parking', '$espace_exterieur', $valide, '$Id_U')";
            $result = mysqli_query($conn,$sql);
        if(!empty($photo)){  
            if(move_uploaded_file($photo_tmp_name,$target_path)){    
                
                $mail = new PHPMailer(true);
                $sql_email = "SELECT email FROM utilisateur WHERE email !='contaoussama17@gmail.com' ";
                $result_email = mysqli_query($conn,$sql_email);
                while ($row = mysqli_fetch_assoc($result_email)) {
                    $email = $row['email'];
                    
                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'contaoussama17@gmail.com';                     //SMTP username
                        $mail->Password   = 'hbrrnzjwanqjorto';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    
                        //Recipients
                        $mail->setFrom('from@example.com', 'BaytiShop');
                        $mail->addAddress($email);     //Add a recipient
                        $message = "A new announcement has been posted: $titre in wilaya of $ville. Check it out on our website!";
                        $subject = "New Announcement";
                    
                        //Content
                        $mail->isHTML(true);                //Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = $message ;
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                        $mail->send();
                        echo '
                        <script>
                            alert("Message has been sent");
                        </script>
                        ';
                    } catch (Exception $e) {
                        echo '
                        <script>
                            alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo};");
                        </script>
                        ';
                    }
                }

                if( mysqli_query($conn,$sql)){
                    header('location:Mes_annonce.php');    
                    exit();
                }else{
                    echo "<script>
                        alert('L\'insertion est erronée!!');
                    </script>";
                    include('deposer.php');
                    exit();
                }    
            }
        }else {
            $photo_error = '<p id="error">Veuillez choisir une image au format PNG, JPG, SVG ou JPEG et dont la taille est inférieure à 4 Mo.</p>';
            $err_s = 1;
            include('deposer.php');
        }
        }
    }
}else{
    include('deposer.php');
}
}
?>
