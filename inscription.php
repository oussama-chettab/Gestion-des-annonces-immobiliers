<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    <title>INSCRIPTION</title>
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
    
    <div class="navbar">
        <div class="icon">
            <a href="acceuil.php"><img class="logo" src="images/logo_small.png" alt="Logo"/></a>
            <p>BaytiShop</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="annonce.php">Annonce</a></li>
                <li><a href="Location.php">Locataire</a></li>
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
    
    <div class="menu_insc">
        <div class="icon_insc">
           <img src="images/logo_small.png" alt="icon"> 
           <h2>INSCRIPTION</h2>
        </div>
        
        <form class="form_insc" action="traitement_inscription.php" method="post" >
            <?php
                if(isset($nom_error)){
                    echo $nom_error;
                }
            ?>
            <input type="text" id="nom" name="nom" placeholder=" Nom"><br>
            <?php
                if(isset($prenom_error)){
                    echo $prenom_error;
                }
            ?>
            <input type="text" id="prenom" name="prenom" placeholder=" Prenom" ><br>
            <?php
                if(isset($adresse_error)){
                    echo $adresse_error;
                }
            ?>
            <input type="text" id="adresse" name="adresse" placeholder=" Adresse" ><br>
            <?php
                if(isset($email_error)){
                    echo $email_error;
                }
            ?>
            <input type="email" id="email" name="email" placeholder=" Email@BaytiShop.com" ><br>
            <?php
                if(isset($tel_error)){
                    echo $tel_error;
                }
            ?>
            <input type="tel" id="tel" name="tel" placeholder=" Tel (+213)000 000 000" ><br>
            <?php
                if(isset($wilaya_error)){
                    echo $wilaya_error;
                }
            ?>
            <select id="ville" name="ville" onchange="populateCommunes()">
                <option disabled selected value="">-- Sélectionnez ville --</option>
                <option value="Alger">Alger</option>
                <option value="Annaba">Annaba</option>
                <option value="Constantine">Constantine</option>
                <option value="Setif">Sétif</option>
                <option value="Bejaia">Béjaia</option>
                <option value="Jijel">Jijel</option>
                <option value="Oumbouaki">OumBouaki</option>
                <option value="Taraf">Taref</option>
            </select><br>
            <?php
                if(isset($pass_error)){
                    echo $pass_error;
                }
            ?>
            <input type="password" id="motdepasse" name="motdepasse" placeholder=" Mot de passe" ><br>

            <input type="submit" name="soumettre" value="INSCRIPTION">
        </form>

        <div class="rtrcnx">
            <p>Vous avez déjà un compte? Retour à la <a href="Connexion.php">Connexion</a></p>
        </div>
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
    <script src="js/inscription.js"></script>
</html>