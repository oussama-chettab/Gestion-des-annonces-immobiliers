<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1; user-scalable">
    <title>Location</title>
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/Location.css">
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
    </div>
    
    <div class="img_txt">
        <img src="images/istockphoto-183110092-612x612.jpg" alt="photo"> 
        <div class="txt">
            <h1 class="text">Bienvenue sur votre premier site immobilier <br>
            Rechercher selon votre préférences</h1> 
        </div>    
    </div>
    <h2>Consultez nos annonces immobilières et trouvez le bien idéal !</h2>
    <div class="bar_cherche">
    <form action="Preference.php" method="post">
        <img src="images/logo_white_large.png" alt="BaytiShop-photo-">
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
        <select id="chambre" name="chambre">
            <option value="">-- Sélectionnez nombre des chambres --</option>
            <option value="chambre">chambre</option>
            <option value="2 chambres">2 chambres</option>
            <option value="3 chambres">3 chambres</option>
            <option value="4 chambres">4 chambres</option>
            <option value="5 chambres">5 chambres</option>
            <option value="6 chambres ou+">6 chambre ou+</option>
        </select>
        <select id="etage" name="etage">
            <option value="">-- Sélectionnez etage --</option>
            <option value="rez de chaussee">rez de chaussee</option>
            <option value="1 etage">1 etage</option>
            <option value="2 etage">2 etage</option>
            <option value="3 etage">3 etage</option>
            <option value="4 etage">4 etage</option>
            <option value="5 etage ou+">5 etage ou+</option>
        </select>
        <input type="button" value="+Plus critère" class="btn1" onclick="toggleLabels()">
        <label for="meublé"><input type="checkbox" name="meublé" id="meublé" value="meublé"> Meublé</label>
        <label for="electromenager"><input type="checkbox" name="electromenager" id="electromenager" value="electromenager"> Electroménager</label>
        <label for="jardin"><input type="checkbox" name="jardin" id="jardin" value="jardin"> Jardin</label>
        <label for="piscine"><input type="checkbox" name="piscine" id="piscine" value="piscine"> Piscine</label>
        <label for="garage"><input type="checkbox" name="garage" id="garage" value="garage"> Garage</label>
        <label for="parking"><input type="checkbox" name="parking" id="parking" value="parking"> Parking</label>
        <label for="espace_exterieure"><input type="checkbox" name="espace_exterieure" id="espace_exterieure" value="espace_exterieure"> Espace exterieure</label>
        <button type="submit" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    </div>
    
    <div class="annonce_valide">
    <?php 
        
        $infos = mysqli_query($conn, " SELECT * FROM annonce WHERE id_A<'4' ");
        while($dt = mysqli_fetch_array($infos)){
            if($valide = 1){
                $valide = $dt['valide'];
                $photo = $dt['photo'];
                $annonceId = $dt['id_A'];
                $url = 'Annonce_info.php?id_A=' . $annonceId;
    ?>
        
    <div class="annonce">
    <h3><a href="<?php echo $url; ?>"> <?php echo $dt['type_annonce'].' '.$dt['type_bien'] ;?></a></h3><br>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" alt="Image" class="img_A">
        <div class="inf">
            <h4 style="color: rgba(20, 83, 154, 0.9);"><i class="fa-solid fa-location-dot"></i> <?php echo $dt['ville'] ;?></h4><br>
            <h4><i class="fa-solid fa-tag"></i> <?php echo $dt['titre'] ;?></h4><br>
            <h4>Surface : <?php echo $dt['surface'] ;?> m²</h4><br>
            <h4><i class="fa-solid fa-city"></i><?php echo $dt['etage'] ;?></h4>
        </div>
    </div>        
    
    <?php 
        }}
        $conn->close();
    ?>
    </div>

    <div class="site-description">
        <p>Bienvenue sur BaytiShop, votre agence immobilière de confiance. Nous sommes spécialisés dans la vente et la location de biens immobiliers résidentiels et commerciaux à travers le pays. Notre équipe de professionnels expérimentés est dédiée à vous offrir un service de qualité supérieure pour répondre à tous vos besoins en matière de logement et d'investissement immobilier. Parcourez notre site pour découvrir notre large sélection de propriétés et n'hésitez pas à nous contacter pour toute demande d'information supplémentaire.</p>
        <div class="contact-info">
            <p><a href=""><i class="fas fa-map-marker-alt"></i> Rue_Elnasser IbnZiad-Constantine Algérie</p></a>
            <p><a href=""><i class="fas fa-phone"></i> (Djezzy) 781 58 94 03</p></a>
            <p><a href=""><i class="fas fa-envelope"></i> contaoussama17@gmail.com</p></a>
        </div>
    </div>
    <script src="js/locataire.js"></script>
</body>
</html>