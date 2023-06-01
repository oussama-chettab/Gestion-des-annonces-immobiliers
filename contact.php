<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    <title></title>
    <link rel="stylesheet" href="css/contact.css">
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
                    echo '<a href="connexion.php" class="button"><i class="fas fa-sign-in-alt"></i>Connexion / Inscription</a>';  
                }
            ?>
        </div>   
    </div>    

    <div class="menu_contact">
        <div class="icon_insc">
           <img src="images/logo_small.png" alt="icon"> 
           <h2>CONTACTER</h2>
        </div>
        <form class="form_contact" action="contact_envoye.php" method="POST">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
        
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
      
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        
            <label for="telephone">Téléphone:</label>
            <input type="tel" id="telephone" name="telephone" required>
      
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
      
            <input type="submit" name="envoyer" value="Envoyer">
        </form>
    </div>

</body>
    <script src="js/contact.js"></script>
</html>