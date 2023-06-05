<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1; user-scalable">
    <title>Anonce</title>
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/annonce.css">
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
                <li><a href="Location.php">Preference</a></li>
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
                    $info = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email='$email' ");
                    $row = mysqli_fetch_array($info);
                    echo '<a href="profil.php" class="button"><i class="fa-regular fa-user"></i> '.$row["Nom"].'</a>';
                    
                }else{
                    echo '<a href="connexion.php" class="button"><i class="fas fa-sign-in-alt"></i> Connexion / Inscription</a>';  
                }
            ?>

        </div>   
    </div><br>
    <div class="annonce_valide">
    <?php 
    
        $infos = mysqli_query($conn, " SELECT * FROM annonce ");
        while($dt = mysqli_fetch_array($infos)){          
                $valide = $dt['valide'];
                $photo_data = $dt['photo'];
                $photo_base64 = base64_encode($photo_data);
                
                $annonceId = $dt['id_A'];
                $url = 'Annonce_info.php?id_A=' . $annonceId;
                $_SESSION['id_A'] = $dt['id_A'];
            if($valide == 1){   
                
    ?>
        
        <div class="annonce">
        <h3><a href="<?php echo $url; ?>"> <?php echo $dt['type_annonce'].' '.$dt['type_bien'] ;?></a></h3><br>
        <img src="data:image/jpeg;base64,<?php echo $photo_base64; ?>" alt="Image" class="img_A">
            <div class="inf">
                <h4 style="color: rgba(20, 83, 154, 0.9);"><i class="fa-solid fa-location-dot"></i> <?php echo $dt['ville'] ;?></h4><br>
                <h4><i class="fa-solid fa-tag"></i> <?php echo $dt['titre'] ;?></h4><br>
                <h4>Surface : <?php echo $dt['surface'] ;?> m²</h4><br>
                <h4><i class="fa-solid fa-city"></i><?php echo $dt['etage'] ;?></h4>
            </div>
        </div>        
    
    <?php 
            }
        }
        $conn->close();
    ?>
    </div>
    <div class="site-description">
        <p>Bienvenue sur BaytiShop, votre agence immobilière de confiance. Nous sommes spécialisés dans la vente et la location de biens immobiliers résidentiels et commerciaux à travers le pays. Notre équipe de professionnels expérimentés est dédiée à vous offrir un service de qualité supérieure pour répondre à tous vos besoins en matière de logement et d'investissement immobilier. Parcourez notre site pour découvrir notre large sélection de propriétés et n'hésitez pas à nous contacter pour toute demande d'information supplémentaire.</p>
        <div class="contact-info">
            <p><a href="#"><i class="fas fa-map-marker-alt"></i> Rue_Elnasser IbnZiad-Constantine Algérie</p></a>
            <p><a href="#"><i class="fas fa-phone"></i> (Djezzy) 781 58 94 03</p></a>
            <p><a href="#"><i class="fas fa-envelope"></i> contaoussama17@gmail.com</p></a>
        </div>
    </div>
</body> 
    <script src="annonce.js"></script> 
</html>
