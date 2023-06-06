<?php
    session_start();
    include('config.php');
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $info = mysqli_query($conn, "SELECT * FROM utilisateur WHERE email='$email'");
        $row = mysqli_fetch_array($info);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1; user-scalable">
    <title>Profil</title>
    <link rel="stylesheet" href="css/profil.css">
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
            <button><a href="deposer.php">Déposer une annonce</a></button>
            <a href="profil.php" class="button login-button">
                <i class="fa-regular fa-user"></i><?php echo $row['Nom']; ?> 
            </a>
        </div>
    </div>
    <div class="serv">
        <h2>Mon espace</h2>
        <ul>
            <li><a href="Mes_annonce.php"><i class="fa-solid fa-pen"></i> Mes annonces</a></li>
            <li><a href="FAVORIS.php"><i class="fa-solid fa-star"></i> Favoris</a></li>
            <li><a href="https://mail.google.com/"><i class="fa-regular fa-bell"></i> Alerts e-mail</a></li>
            <li><a href="Edit_user.php"><i class="fa-regular fa-user"></i> Profil (Modifier)</a></li>
            <?php if($email =='contaoussama17@gmail.com'){
                echo '<li><a href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=projet"><i class="fa-solid fa-gear"></i> Gestion de BD</a></li>';
            } ?>
            <li><a href="deconnecter.php"><i class="fas fa-sign-in-alt"></i> Déconnecté</a></li>
        </ul>
    </div>
    <h2 class="bvn">Bienvenue sur votre espace</h2><br><br>
    <div class="serv_box">
        
        <div class="box_annonce">
            <i class="fa-solid fa-pen fa-4x"></i>
            <h2>Mes annonces</h2>
            <p>Gérez vos annonces en tout simplicité</p>
            <a href="Mes_annonce.php"><button>Mes annonces</button></a>
        </div>
        <div class="box_annonce">
            <i class="fa-solid fa-star fa-4x"></i>
            <h2>Mes favoris</h2>
            <p>Retrouvez les annonce que vous avez sélectionnées</p>
            <a href="FAVORIS.php"><button>Mes favoris</button></a>
        </div>
        <div class="box_annonce">
            <i class="fa-regular fa-bell fa-4x"></i>
            <h2>Alerts e-mail</h2>
            <p>Gérer vos alertes e-mails</p>
            <a href="https://mail.google.com/"><button>Alerts e-mail</button></a>
        </div>
    </div>
</body>
    <script src="js/profil.js"></script>
</html>
<?php
    } 
?>