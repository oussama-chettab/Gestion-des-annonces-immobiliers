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
    <link rel="stylesheet" href="css/agence.css">
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
            <a href="profil.php" class="button login-button">
              <i class="fas fa-sign-in-alt"></i> Connexion / Inscription
            </a>
        </div>   
    </div>
    <div class="bar_cherche">
        <form action="chercher_agence.php" method="get">
            <img src="images/logo_white_large.png" alt="">
            <input type="text" name="cherche" id="cherche" placeholder="Chercher">
            <select name="ville" id="wilaya">
                <option value="">-- Sélectionnez wilaya --</option>
                <option value="alger">Alger</option>
                <option value="annaba">Annaba</option>
                <option value="constantine">Constantine</option>
                <option value="setif">Sétif</option>
                <option value="bejaia">Béjaia</option>
                <option value="jijel">Jijel</option>
                <option value="oumbouaki">OumBouaki</option>
                <option value="taraf">Taref</option>
            </select>
            <select name="nom_adresse" id="nom_adresse">
                <option value="Nom de l'agence">Nom de l'agence</option>
                <option value="Adresse">Adresse</option>
            </select>
            <button type="submit" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <h2>AGENCE DISPONIBLE</h2>    
    <div class="agences">
<?php 
    include('config.php');
    $recherche = $_GET['cherche'];
    $ville = $_GET['ville'];
    $nom_adresse = $_GET['nom_adresse'];

    $sql = "SELECT * FROM agence WHERE ";
    if ($nom_adresse == "Nom de l'agence") {
        $sql .= "Nom_Ag LIKE '%$recherche%'";
    } elseif ($nom_adresse == "Adresse") {
        $sql .= "adresse LIKE '%$recherche%'";
    }
    
    if (!empty($ville)) {
        $sql .= " AND ville = '$ville'";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $photo = $row['photo'];
            $agenceId = $row['Id_Ag'];
            $url = 'agence_info.php?Id_Ag=' . $agenceId;
?>          
    <div class="box_agence">
        <a href="<?php echo $url; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" alt="Image" style="height:350px; width:393px;"></a><br><br>
        <h4><i class="fa-solid fa-tag"></i> Agence: <?php echo $row['Nom_Ag'] ;?></h4><br>
        <h4><i class="fa-solid fa-location-dot"></i> Adresse: <?php echo $row['adresse'] ;?><br> 
        <?php echo 'ville de '.$row['ville'] ;?></h4><br>
        <h4><i class="fa-solid fa-envelope"></i> Email: <?php echo $row['email'] ;?></h4><br>
        <h4><i class="fa-solid fa-phone"></i> Tel: 0<?php echo $row['tel'] ;?></h4><br>  
    </div>

<?php            
        }
    }else {
        echo "Aucun résultat trouvé.";
    }
    $conn->close();
?>
    </div>
</body>
    <script src="js/agence.js"></script>
</html>