
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf_8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1; user-scalable">
        <title>BaytiShop</title>
        <link rel="stylesheet" href="css/Acceuil.css">
        <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
        <link rel="stylesheet" href="css/all.css">
    </head>
<body>
    <div class="main">
        <div class="navbar">
            <div class="icon">
                <a href="acceuil.php"><img class="logo" src="images/logo_small.png" alt="Logo"/></a>
                <p>BaytiShop</p>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="annonce.php">Anonces</a></li>
                    <li><a href="Location.php">Preference</a></li>
                    <li><a href="agences.php">Agences</a></li>
                    <li><a href="Statistiques.php">Statistique</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>                
            </div>
            
            

            <div class="button-container">
                <button><a href="connexion.php">Déposer une annonce</a></button>
                
                <?php 
                    session_start();
                    include('config.php');
                    if(isset($_SESSION['email'])){
                        $email = $_SESSION['email'];
                        $info = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email='$email' ");
                        $row = mysqli_fetch_array($info);
                        echo '<a href="profil.php" class="button"><i class="fa-regular fa-user"></i> '.$row["Nom"].'</a>';
                        
                    }else{
                        echo '<a href="connexion.php" class="button"><i class="fas fa-sign-in-alt"></i>Connexion / Inscription</a>';  
                    }
                ?>
            </div>
              
              
        </div>
        
        <div class="img_txt">
            <img src="images/deco6.jpg" alt="photo"> 
            <div class="txt">
                <h1 class="text">Bienvenue sur votre premier site immobilier <br>
                Notre offre de gestion locative à l'année </h1>
            </div>    
        </div>

    <div class="questionnaire">
        <h2>Consultez nos annonces immobilières et trouvez le bien idéal !</h2>
        <form action="Preference.php" method="POST">   
            <select name="type_annonce" id="type_annonce">
                <option value="">-- Sélectionnez un Type d'annonce --</option>
                <option value="Location">Location</option>
                <option value="Vente">Vente</option>
                <option value="Colocation">Colocation</option>
                <option value="Location_Vacances">Location Vacances</option>
            </select>

            <select id="type_bien" name="type_bien" >
                <option value="">-- Sélectionnez un type de bien --</option>
                <option value="appartement">Appartement</option>
                <option value="maison">Maison</option>
                <option value="terrain">Terrain</option>
                <option value="bureau">Bureau</option>
                <option value="atelier">Atelier</option>
                <option value="chateau">Chateau</option>
                <option value="clinique">Clinique</option>
                <option value="ecole">Ecole</option>
                <option value="gymnase">Gymnase</option>
            </select>
            
            <select id="ville" name="ville">
                <option value="">-- Sélectionnez ville --</option>
                <option value="alger">Alger</option>
                <option value="annaba">Annaba</option>
                <option value="constantine">Constantine</option>
                <option value="setif">Sétif</option>
                <option value="bejaia">Béjaia</option>
                <option value="jijel">Jijel</option>
                <option value="oumbouaki">OumBouaki</option>
                <option value="taraf">Taref</option>
            </select>
                
            <input type="number" id="prix" name="prix" placeholder="PRIX (DA)">
                
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i>Chercher</button>
            <a href="Location.php"><i class="fa-solid fa-magnifying-glass"></i> Recherche avancé</a>
        </form>
        </div>
    </div>
              
    <h1 style="text-align: center;">Top Anonces</h1>    

<div class="annonce_valide">                       
<?php
$user_info = mysqli_query($conn, "SELECT * FROM annonce WHERE id_A < 4 ");
while($data = mysqli_fetch_array($user_info)){
    if($valide = 1){
        $valide = $data['valide'];
        $photo = $data['photo'];
        $annonceId = $data['id_A'];
        $url = 'Annonce_info.php?id_A=' . $annonceId;
?>

    <div class="annonce">
    <h3><a href="<?php echo $url; ?>"> <?php echo $data['type_annonce'].' '.$data['type_bien'] ;?></a></h3><br>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" alt="Image" class="img_A">
        <div class="inf">
            <h4 style="color: rgba(20, 83, 154, 0.9);"><i class="fa-solid fa-location-dot"></i> <?php echo $data['ville'] ;?></h4><br>
            <h4><i class="fa-solid fa-tag"></i> <?php echo $data['titre'] ;?></h4><br>
            <h4>Surface : <?php echo $data['surface'] ;?> m²</h4><br>
            <h4><i class="fa-solid fa-city"></i><?php echo $data['etage'] ;?></h4>
        </div>
    </div>  
                
<?php
}
}
$conn->close();
?>
    </div>
</section>
        <div class="rejoignez_nous">
            <img src="images/image-rejoint.jpeg" alt="photo">
            <div class="descript_nous"><h1>Rejoignez-nous</h1>
                <p>Notre plateforme, est la première en Algérie, ou seuls les agents <br>
                immobiliers agréés, peuvent y exposer leurs offres immobilières, à <br>
                destination du grand public. L'objectif est double : d'une part, permettre <br>
                aux professionnels de mettre en valeur leur catalogue et aux clients <br>
                (particuliers, entreprises, administrations, associations, etc...) de trouver <br>
                rapidement le bien correspondant à leurs critères.</p>
                <button><a href="inscription.php">Rejoignez nous</a></button>
            </div>
        </div>

        
        <div class="Abonnez_vous">
            <h1>Abonnez-vous et profitez de</h1>
            <div class="information">
                <div class="inf">
                    <i class="fa-solid fa-business-time fa-3x"></i>
                    <p>Une plateforme simple d’usage</p>            
                </div>
                <div class="inf">
                    <i class="fa-solid fa-cart-shopping fa-3x"></i>
                    <p>Consultez des offres de professionnels</p>
                </div>
                <div class="inf">
                    <i class="fa-solid fa-hand-holding-dollar fa-3x"></i>
                    <p>Economisez de l'argent!</p>
                </div>
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
       
    </div>

</body>
    <script src="js/acceuil.js"></script>
</html>