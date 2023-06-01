<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1; user-scalable">
    <title>Agences</title>
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/agence_info.css">
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
        <a href="profil.php" class="button login-button">
            <i class="fas fa-sign-in-alt"></i> Connexion / Inscription
        </a>
    </div>   
</div>

<div class="agence_info">
    <?php
        include('config.php');

        if (isset($_GET['Id_Ag'])) {
            $agenceId = $_GET['Id_Ag'];
    
            // Effectuez la requête pour récupérer les informations de l'agence avec l'identifiant correspondant
            $query = "SELECT * FROM agence WHERE Id_Ag = $agenceId";
            $result = mysqli_query($conn, $query);
            $agence = mysqli_fetch_assoc($result);
            if ($agence) {
                $photo = $agence['photo'];
    ?>

    <div class="box_agence">
        <a href="<?php echo $url; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" alt="Image" style="height:350px;"></a><br><br>
        <h4><i class="fa-solid fa-tag"></i> Agence: <?php echo $agence['Nom_Ag'] ;?></h4><br>
        <h4><i class="fa-solid fa-location-dot"></i> Adresse: <?php echo $agence['adresse'] ;?> <?php echo $agence['ville'] ;?></h4><br>
        <h4><i class="fa-solid fa-envelope"></i> Email: <?php echo $agence['email'] ;?></h4><br>
        <h4><i class="fa-solid fa-phone"></i> Tel: 0<?php echo $agence['tel'] ;?></h4><br>
    </div>

    <?php            
            } else {
                echo '<h1>Agence introuvable</h1>';
            }
        }
        $conn->close();
    ?>

    <div class="contacter">
        <h2><i class="fa-solid fa-envelope"></i> Contacter l'agence</h2>
        <form action="envoyer_email.php" method="POST">
            <input type="hidden" name="agenceId" value="<?php echo $agenceId ?>"><br>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea><br>
            <input type="submit" value="Envoyer">
        </form>
    </div>
</div>        
    
</body>
</html>