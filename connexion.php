<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf_8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Identifiez_vous dans BaytiShop.com</title>
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
    </div>
    
    <section>
        <div class="form-box">
            <h1>Connectez_vous</h1>
            <p>Utilisez le formulaire ci-dessous pour vous connecter a votre compte.</p>
            <form class="form_conn" action="seconnecter.php" method="post">
                <?php
                    if(isset($connexion_error)){
                        echo $connexion_error;
                    }
                ?>
                <?php
                    if(isset($email_error)){
                        echo $email_error;
                    }
                ?>
                <input type="email" id="email" name="email" placeholder="Email" >
                
                <?php
                    if(isset($pass_error)){
                        echo $pass_error;
                    }
                ?>
                
                <input type="password" id="password" name="motdepasse" placeholder="Mot de passe" >
                <span class="show-password" onclick="Show()"><i class="fa fa-eye" aria-hidden="true"></i></span>
                
                <button type="submit">CONNEXION</button>
                <a href="confirmdp.php" id="forgot-password-link">Mot de passe oublié ?</a>
            </form>
            <h2>Créer votre annonce</h2>
            <p>Publier vos annonces sur le meilleur site immobilier en Algerie.</p>
            <button class="btn"><a href="inscription.php">INSCRIPTION</a></button>
        </div>
    </section>
    <div class="site-description">
        <p>Bienvenue sur BaytiShop, votre agence immobilière de confiance. Nous sommes spécialisés dans la vente et la location de biens immobiliers résidentiels et commerciaux à travers le pays. Notre équipe de professionnels expérimentés est dédiée à vous offrir un service de qualité supérieure pour répondre à tous vos besoins en matière de logement et d'investissement immobilier. Parcourez notre site pour découvrir notre large sélection de propriétés et n'hésitez pas à nous contacter pour toute demande d'information supplémentaire.</p>
        <div class="contact-info">
          <p><a href="#"><i class="fas fa-map-marker-alt"></i> Rue_Elnasser IbnZiad-Constantine Algérie</p></a>
          <p><a href="#"><i class="fas fa-phone"></i> (Djezzy) 781 58 94 03</p></a>
          <p><a href="#"><i class="fas fa-envelope"></i> contaoussama17@gmail.com</p></a>
        </div>
    </div>  
</body>
    <script src="js/connexion.js"></script>
</html>