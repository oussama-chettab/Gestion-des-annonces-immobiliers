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
                echo '<a href="profil.php" class="button"><i class="fa-regular fa-user"></i> ' .$row["Nom"].'</a>';
                
            }else{
                echo '<a href="connexion.php" class="button"><i class="fas fa-sign-in-alt"></i> Connexion / Inscription</a>';  
            }
        ?>
        </div>   
    </div>
    <div class="img_txt">
        <img src="images/Agence_immobilière-a1.jpg" alt="photo"> 
        <div class="txt">
            <h1 class="text"><br>Agences immobilières</h1> 
        </div>    
    </div>
    <h2>Consultez nos agences immobilières et trouvez l'agence idéal !</h2>
    <div class="bar_cherche">
        <form action="chercher_agence.php" method="get">
            <img src="images/logo_white_large.png" alt="BaytiShop-photo-">
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
        $info = mysqli_query($conn, " SELECT * FROM agence ");
        while($data = mysqli_fetch_array($info)){
            $photo = $data['photo'];
            $agenceId = $data['Id_Ag'];
            $url = 'agence_info.php?Id_Ag=' . $agenceId;
    ?>        
        <div class="box_agence">
            <h3><i class="fa-solid fa-tag"></i> <?php echo $data['Nom_Ag'] ;?></h3><br>
            <a href="<?php echo $url; ?>"><img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" alt="Image" style="height:350px; width:393px;"></a><br><br>
            <h4><i class="fa-solid fa-location-dot"></i> Adresse: <?php echo $data['ville'] ;?></h4><br>
            <h4><?php echo $data['adresse'] ;?></h4><br>
            <h4><i class="fa-solid fa-envelope"></i> Email: <?php echo $data['email'] ;?></h4><br>
            <h4><i class="fa-solid fa-phone"></i> Tel: 0<?php echo $data['tel'] ;?></h4><br>
        </div>
        
    <?php
        }
        $conn->close(); 
    ?>
    </div>

</body>
    <script src="js/agence.js"></script>
</html>