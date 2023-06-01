<?php 
   session_start();
   include('config.php');
   if(isset($_SESSION['email'])){ 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf_8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1; user-scalable">
        <title>Deposer annonce</title>
        <link rel="stylesheet" href="css/deposer.css">
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
                    <li><a href="annonce.php">Anonce</a></li>
                    <li><a href="Location.php">Location</a></li>
                    <li><a href="agences.php">Agences</a></li>
                    <li><a href="Statistiques.php">Statistique</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>         
            </div>
            <div class="button-container">
            <?php 
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

        <div class="formulair">
            <form id="annonce-form" action="traitement_deposer.php" method="POST" enctype="multipart/form-data">
                <h2 style="text-align: center; background: transparent;">Remplez formulaire et déposer votre annonce</h2><br><br>
                <label for="type">Type d'annonce :</label>
                <select name="type_annonce" id="type_annonce">
                    <option value="">-- Sélectionnez un Type d'annonce --</option>
                    <option value="Location">Location</option>
                    <option value="Vente">Vente</option>
                    <option value="Colocation">Colocation</option>
                    <option value="Location_Vacances">Location Vacances</option>
                </select>
                <?php
                    if(isset($type_annonce_error)){
                        echo $type_annonce_error;
                    }
                ?>
                <br>
                <label for="type">Type de bien :</label>
			    <select id="type_bien" name="type_bien" >
				    <option value="">-- Sélectionnez un type de bien --</option>
				    <option value="Appartement">Appartement</option>
				    <option value="Maison">Maison</option>
				    <option value="Terrain">Terrain</option>
                    <option value="Bureau">Bureau</option>
                    <option value="Atelier">Atelier</option>
                    <option value="Chateau">Chateau</option>
                    <option value="Clinique">Clinique</option>
                    <option value="Ecole">Ecole</option>
                    <option value="Gymnase">Gymnase</option>
			    </select>
                <?php
                    if(isset($type_error)){
                        echo $type_error;
                    }
                ?>
                <br>
                <label for="titre">Titre de l'annonce :</label>
			    <input type="text" id="titre" name="titre" >
                
                <label for="adresse">Adresse :</label>
			    <input type="text" id="adresse" name="adresse" >

                <label for="description">Description :</label>
			    <textarea id="description" name="description" rows="5" maxlength="1000"></textarea>

                <label for="prix">Prix (DA) :</label>
			    <input type="number" id="prix" name="prix" >

                <label for="ville">ville :</label>
			    <select id="ville" name="ville" >
				    <option disabled value="">-- Sélectionnez ville --</option>
				    <option value="Alger">Alger</option>
				    <option value="Annaba">Annaba</option>
				    <option value="Constantine">Constantine</option>
                    <option value="Setif">Sétif</option>
                    <option value="Bejaia">Béjaia</option>
                    <option value="Jijel">Jijel</option>
                    <option value="Oumbouaki">OumBouaki</option>
                    <option value="Taraf">Taref</option>
			    </select>
                <?php
                    if(isset($ville_error)){
                        echo $ville_error;
                    }
                ?><br>
                <label for="photo">Photo :</label>
			    <input type="file" id="photo" name="photo" accept="image/*" >
                
                <label for="chambre">Chambres</label>
                <select id="chambre" name="chambre">
                    <option value="">-- Sélectionnez nombre des chambres --</option>
                    <option value="chambre">chambre</option>
                    <option value="2 chambres">2 chambres</option>
                    <option value="3 chambres">3 chambres</option>
                    <option value="4 chambres">4 chambres</option>
                    <option value="5 chambres">5 chambres</option>
                    <option value="6 chambres ou+">6 chambres ou+</option>
                </select>
                <?php
                    if(isset($chambre_error)){
                        echo $chambre_error;
                    }
                ?><br>
                <label for="Etage">Etage</label>
                <select id="etage" name="etage">
                    <option value="">-- Sélectionnez etage --</option>
                    <option value="rez de chaussee">rez de chaussee</option>
                    <option value="1 etage">1 etage</option>
                    <option value="2 etage">2 etage</option>
                    <option value="3 etage">3 etage</option>
                    <option value="4 etage">4 etage</option>
                    <option value="5 etage ou+">5 etage ou+</option>
                </select>
                <?php
                    if(isset($etage_error)){
                        echo $etage_error;
                    }
                ?><br>
                <label for="surface">Surface (m²) :</label>
			    <input type="number" id="surface" name="surface" >

                <label for="meublé"><input type="checkbox" name="meublé" id="meublé" value="meublé"> Meublé</label>
                <label for="electromenager"><input type="checkbox" name="electromenager" id="electromenager" value="electromenager"> Electroménager</label>
                <label for="jardin"><input type="checkbox" name="jardin" id="jardin" value="jardin"> Jardin</label>
                <label for="piscine"><input type="checkbox" name="piscine" id="piscine" value="piscine"> Piscine</label>
                <label for="garage"><input type="checkbox" name="garage" id="garage" value="garage"> Garage</label>
                <label for="parking"><input type="checkbox" name="parking" id="parking" value="parking"> Parking</label>
                <label for="espace_exterieure"><input type="checkbox" name="espace_exterieure" id="espace_exterieure" value="espace_exterieure"> Espace exterieure</label>
                <br>
                <button type="submit" name="submit">Déposer l'annonce</button>
            </form>
        </div>
            
    </body>
    <script src="js/deposer.js"></script>
</html>
<?php 
}else{
    echo 
    '<script>
        alert("L\'insertion est erronée!!");
    </script>';
    header('Location: connexion.php');
} 
?>