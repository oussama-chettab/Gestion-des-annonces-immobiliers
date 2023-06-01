<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1; user-scalable">
    <title>Annonce</title>
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/Annonce_info.css">
</head>
<body>
    <div class="navbar">
        <div class="icon">
            <a href="acceuil.php"><img class="logo" src="images/logo_small.png" alt="Logo"/></a>
            <p>BaytiShop</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="annonce.php">Annonces</a></li>
                <li><a href="Location.php">Locataire</a></li>
                <li><a href="agences.php">Agences</a></li>
                <li><a href="Statistiques.php">Statistique</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="button-container">
            <?php 
                session_start();
                include('config.php');
                if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $info = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email='$email'");
                    $row = mysqli_fetch_array($info);
                    echo '<a href="profil.php" class="button"><i class="fa-regular fa-user"></i> '.$row["Nom"].'</a>';
                    
                }else{
                    echo '<a href="connexion.php" class="button"><i class="fas fa-sign-in-alt"></i> Connexion / Inscription</a>';  
                }
            ?>
        </div>   
    </div><br>
<div class="info_A">
    <div class="txt_annonce">
    <?php
        
        if (isset($_GET['id_A'])) {
            $annonceId = $_GET['id_A'];
            $query = "SELECT * FROM annonce WHERE id_A = '$annonceId' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['id_A'] = $row['id_A'];
                $typeAnnonce = $row['type_annonce'];
                $typeBien = $row['type_bien'];
                $photo = $row['photo'];
                $ville = $row['ville'];
                $titre = $row['titre'];
                $surface = $row['surface'];
                $etage = $row['etage'];
                $prix = $row['prix'];
                $Id_U = $row['id_U'];
                
    ?>
                
    <div class="FAV">
        <h2><i class="fa-solid fa-tag"></i><?php echo $typeAnnonce.' '.$typeBien; ?></h2>
        <form action="Ajou_fav.php" method="POST">
            <input type="hidden" name="annonceId" value="<?php echo $annonceId;?> ">
            <button type="submit" name="submit" class="favoris"><i class="fa-solid fa-heart fa-2x"></i></button>
        </form>
    </div>
                
    <?php
                echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'" alt="Image" class="img_A" style="height:350px; width:393px;" > ';
                echo '<p><strong>Titre: </strong>'.$titre.'</p>';
                echo '<p><strong>PRIX: </strong>'.$prix.'DA</p>';
                echo '<p><strong>Ville: </strong>'.$ville.'</p>';
                echo '<p><strong>Surface: </strong>'.$surface.' m²</p>';
                echo '<p><strong>Étage: </strong>'.$etage.'</p>';
                echo '<p><strong>Description: </strong><br>'.$row['description'].'</p><br>';

            $query1 = " SELECT * FROM utilisateur WHERE Id_U='$Id_U' ";
            $result1 = mysqli_query($conn, $query1);
            $data = mysqli_fetch_assoc($result1);
            
    ?>
        <table>
            <tr>
                <td><strong>Plus caractéristiques</strong></td>
            </tr>
            <tr>
                <td>
                    <?php
                        $line = '';
                        if($row['chambres']!=''){
                            $line .= $row['chambres'] . ', ';
                        }
                        if( $row['Meublé']== 1 ){
                            $line .= 'Meublé, ';
                        }
                        if( $row['Electroménager']== 1 ){
                            $line .= 'Electroménager, ';
                        }
                        if( $row['Jardin']== 1 ){
                            $line .= 'Jardin, ';
                        }
                        if( $row['Piscine']== 1 ){
                            $line .= 'Piscine, ';
                        }
                        if( $row['Garage']== 1 ){
                            $line .= 'Garage, ';
                        }
                        if( $row['Parking']== 1 ){
                            $line .= 'Parking, ';
                        }
                        if( $row['Espase_exterieure']== 1 ){
                            $line .= 'Espase_exterieure';
                        }
                        if ($line != '') {
                            $line = rtrim($line, ', ');
                            echo $line;
                        } else {
                            echo 'Aucune information disponible';
                        }    
                    ?>
                </td>
            </tr>
        </table>    
    </div>
    <div class="container">
        <div class="user_annonce">
            <h3>Informations sur l'auteur de la publication :</h3>
            <p><strong><i class="fa-regular fa-user"></i>  Nom de l'auteur : </strong><?php echo $data['Nom']; ?> <?php echo $data['prenom'] ?></p>
            <p><strong><i class="fas fa-envelope"></i>  Email : </strong><?php echo $data['email']; ?></p>
            <p><strong><i class="fas fa-phone"></i>  Tel : </strong>0<?php echo $data['tel']; ?></p>
            <p><strong><i class="fa-solid fa-location-dot"></i>  Adresse : </strong><?php echo $data['adresse']; ?></p>
        </div><br>
        <div class="contacter_annonce">
            <h3>Contacter Annonce</h3>
            <form id="emailForm" action="Email_Envoyer.php" method="POST">
                <input type="hidden" name="agenceId" value="<?php echo $agenceId ?>"><br>
                
                <label for="email"><strong>Email:</strong></label><br>
                <input type="email" id="email" name="email" required><br>
                
                <label for="subject"><strong>Subject :</strong></label><br>
                <input type="text" id="subject" name="subject" required>
                
                <label for="message"><strong>Message:</strong></label><br>
                <textarea id="message" name="message" required></textarea><br>
                <input type="submit" name="envoyer" value="Envoyer" class="btn">
            </form>
        </div>
    </div>
</div>    
    
    <?php
        } else {
            echo 'Aucune annonce trouvée.';
        }
        }
        $conn->close();
    ?>
<script src="js/Email.js"></script>
</body>
</html>