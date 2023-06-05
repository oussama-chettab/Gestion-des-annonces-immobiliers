<?php 
    session_start();
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistique</title>
    <link rel="icon" type="image/png" href="images/logo_small_icon_only_inverted.png"/>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/Stat.css">
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
                if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $info = mysqli_query($conn, "SELECT * FROM utilisateur ");
                    $row = mysqli_fetch_array($info);
                    echo '<a href="profil.php" class="button"><i class="fa-regular fa-user"></i> '.$row["Nom"].'</a>';    
                }else{
                    echo '<a href="connexion.php" class="button"><i class="fas fa-sign-in-alt"></i>Connexion / Inscription</a>';  
                }
            ?>
        </div>   
    </div>

    <div class="img_txt">
        <img src="images/housepricesIT.jpeg" alt="photo"> 
        <div class="txt">
            <h1 class="text">Bienvenue sur votre premier site immobilier <br>
            Notre offre de gestion locative à l'année </h1>
        </div>    
    </div>
    
    <div class="stat">
        <h3>Type d'annonces</h3>
        <div class="tab1">
        <?php 
            $sql = " SELECT COUNT(*) AS total,
            SUM(type_annonce = 'Location') AS location_count, 
            SUM(type_annonce = 'Vente') AS vente_count, 
            SUM(type_annonce = 'Colocation') AS colocation_count, 
            SUM(type_annonce = 'Location_Vacances') AS location_vacances_count  
            FROM annonce ";
            $result = mysqli_query($conn,$sql);
            if($result){
                $row = mysqli_fetch_assoc($result);
                $nb_ann = $row['total'];
                $location_count = $row['location_count'];
                $vente_count = $row['vente_count'];
                $colocation_count = $row['colocation_count'];
                $location_vacances_count = $row['location_vacances_count'];
        
        echo'    
         
         <table>
            <tr style=" background-color: #ddd;">
                <th>Total Annonces</th>
                <th>Location</th>
                <th>Vente</th>
                <th>Colocation</th>
                <th>Location Vacances</th>
            </tr>
            <tr>
                <th>'.$nb_ann.'</th>
                <th>'.$location_count.'</th>
                <th>'.$vente_count.'</th>
                <th>'.$colocation_count.'</th>
                <th>'.$location_vacances_count.'</th>
            </tr>
        </table>
        ';
        }
        ?><br>
        <h3>Type de biens</h3>
        <?php
            $sql1 = "SELECT 
            SUM(type_bien = 'Appartement') AS appartement_count, 
            SUM(type_bien = 'Maison') AS maison_count, 
            SUM(type_bien = 'Terrain') AS terrain_count, 
            SUM(type_bien = 'Bureau') AS bureau_count, 
            SUM(type_bien = 'Atelier') AS atelier_count, 
            SUM(type_bien = 'Chateau') AS chateau_count, 
            SUM(type_bien = 'Clinique') AS clinique_count, 
            SUM(type_bien = 'Ecole') AS ecole_count, 
            SUM(type_bien = 'Gymnase') AS gymnase_count 
            FROM annonce";
            $result1 = mysqli_query($conn, $sql1);
            if($result1){
                $row1 = mysqli_fetch_assoc($result1);
                $appartement_count = $row1['appartement_count'];
                $maison_count = $row1['maison_count'];
                $terrain_count = $row1['terrain_count'];
                $bureau_count = $row1['bureau_count'];
                $atelier_count = $row1['atelier_count'];
                $chateau_count = $row1['chateau_count'];
                $clinique_count = $row1['clinique_count'];
                $ecole_count = $row1['ecole_count'];
                $gymnase_count = $row1['gymnase_count'];
        
        echo'
        <table>
            <tr style=" background-color: #ddd;">
                <th>Appartement</th>
                <th>Maison</th>
                <th>Terrain</th>
                <th>Bureau</th>
                <th>Atelier</th>
                <th>Chateau</th>
                <th>Clinique</th>
                <th>Ecole</th>
                <th>Gymnase</th>
            </tr>
            <tr>
                <th>'.$appartement_count.'</th>
                <th>'.$maison_count.'</th>
                <th>'.$terrain_count.'</th>
                <th>'.$bureau_count.'</th>
                <th>'.$atelier_count.'</th>
                <th>'.$chateau_count.'</th>
                <th>'.$clinique_count.'</th>
                <th>'.$ecole_count.'</th>
                <th>'.$gymnase_count.'</th>
            </tr>
        </table>
        ';
            }
        ?></div><br>
        <h3>Transaction des annonces</h3>
        <?php
            $info = "SELECT 
                    SUM(type_annonce = 'Location' AND type_bien = 'Appartement') AS location_appartement_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Maison') AS location_maison_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Terrain') AS location_terrain_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Bureau') AS location_bureau_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Atelier') AS location_atelier_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Chateau') AS location_chateau_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Clinique') AS location_clinique_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Ecole') AS location_ecole_count,
                    SUM(type_annonce = 'Location' AND type_bien = 'Gymnase') AS location_gymnase_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Appartement') AS vente_appartement_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Maison') AS vente_maison_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Terrain') AS vente_terrain_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Bureau') AS vente_bureau_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Atelier') AS vente_atelier_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Chateau') AS vente_chateau_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Clinique') AS vente_clinique_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Ecole') AS vente_ecole_count,
                    SUM(type_annonce = 'Vente' AND type_bien = 'Gymnase') AS vente_gymnase_count
                    FROM annonce";
            $query = mysqli_query($conn, $info);

            if ($query) {
                $data = mysqli_fetch_assoc($query);
                $location_appartement_count = $data['location_appartement_count'];
                $location_maison_count = $data['location_maison_count'];
                $location_terrain_count = $data['location_terrain_count'];
                $location_bureau_count = $data['location_bureau_count'];
                $location_atelier_count = $data['location_atelier_count'];
                $location_chateau_count = $data['location_chateau_count'];
                $location_clinique_count = $data['location_clinique_count'];
                $location_ecole_count = $data['location_ecole_count'];
                $location_gymnase_count = $data['location_gymnase_count'];
                $vente_appartement_count = $data['vente_appartement_count'];
                $vente_maison_count = $data['vente_maison_count'];
                $vente_terrain_count = $data['vente_terrain_count'];
                $vente_bureau_count = $data['vente_bureau_count'];
                $vente_atelier_count = $data['vente_atelier_count'];
                $vente_chateau_count = $data['vente_chateau_count'];
                $vente_clinique_count = $data['vente_clinique_count'];
                $vente_ecole_count = $data['vente_ecole_count'];
                $vente_gymnase_count = $data['vente_gymnase_count'];

        echo '
        <table>
            <tr style=" background-color: #ddd;">
                <th>Location Appartement</th>
                <th>Location Maisson</th>
                <th>Location Terrain</th>
                <th>Location Bureau</th>
                <th>Location Atelier</th>
                <th>Location Chateau</th>
                <th>Location Clinique</th>
                <th>Location Ecole</th>
                <th>Location Gymnase</th>
            </tr>
            <tr>
                <th>' . $location_appartement_count . '</th>
                <th>' . $location_maison_count . '</th>
                <th>' . $location_terrain_count . '</th>
                <th>' . $location_bureau_count . '</th>
                <th>' . $location_atelier_count . '</th>
                <th>' . $location_chateau_count . '</th>
                <th>' . $location_clinique_count . '</th>
                <th>' . $location_ecole_count . '</th>
                <th>' . $location_gymnase_count . '</th>
            </tr>
        </table>
        <br>';
        echo '
        <table>
            <tr style=" background-color: #ddd;">
                <th>Vente Appartement</th>
                <th>Vente Maisson</th>
                <th>Vente Terrain</th>
                <th>Vente Bureau</th>
                <th>Vente Atelier</th>
                <th>Vente Chateau</th>
                <th>Vente Clinique</th>
                <th>Vente Ecole</th>
                <th>Vente Gymnase</th>
            </tr>
            <tr>
                <th>' . $vente_appartement_count . '</th>
                <th>' . $vente_maison_count . '</th>
                <th>' . $vente_terrain_count . '</th>
                <th>' . $vente_bureau_count . '</th>
                <th>' . $vente_atelier_count . '</th>
                <th>' . $vente_chateau_count . '</th>
                <th>' . $vente_clinique_count . '</th>
                <th>' . $vente_ecole_count . '</th>
                <th>' . $vente_gymnase_count . '</th>
            </tr>
        </table>
        ';
            }
        ?>
        <h3>Agence par Ville</h3>
        <div class="tab1">
        <?php 
            $info1 = " SELECT COUNT(*) AS total,
            SUM(ville = 'Alger') AS Agence_Alger, 
            SUM(ville = 'Annaba') AS Agence_Annaba, 
            SUM(ville = 'Constantine') AS Agence_Constantine, 
            SUM(ville = 'Setif') AS Agence_Setif,
            SUM(ville = 'Bejaia') AS Agence_Bejaia, 
            SUM(ville = 'Jijel') AS Agence_Jijel, 
            SUM(ville = 'Oumbouaki') AS Agence_Oumbouaki, 
            SUM(ville = 'Taref') AS Agence_Taref  
            FROM agence ";
            $query1 = mysqli_query($conn,$info1);
            if($query1){
                $data1 = mysqli_fetch_assoc($query1);
                $nb_Ag = $data1['total'];
                $Agence_Alger = $data1['Agence_Alger'];
                $Agence_Annaba = $data1['Agence_Annaba'];
                $Agence_Constantine = $data1['Agence_Constantine'];
                $Agence_Setif = $data1['Agence_Setif'];
                $Agence_Bejaia = $data1['Agence_Bejaia'];
                $Agence_Jijel = $data1['Agence_Jijel'];
                $Agence_Oumbouaki = $data1['Agence_Oumbouaki'];
                $Agence_Taref = $data1['Agence_Taref'];
        
        echo'    
         
         <table>
            <tr style=" background-color: #ddd;">
                <th>Total Agences</th>
                <th>Alger</th>
                <th>Annaba</th>
                <th>Constantine</th>
                <th>Sétif</th>
                <th>Béjaia</th>
                <th>Jijel</th>
                <th>Oumbouaki</th>
                <th>Taref</th>
            </tr>
            <tr>
                <th>'.$nb_Ag.'</th>
                <th>'.$Agence_Alger.'</th>
                <th>'.$Agence_Annaba.'</th>
                <th>'.$Agence_Constantine.'</th>
                <th>'.$Agence_Setif.'</th>
                <th>'.$Agence_Bejaia.'</th>
                <th>'.$Agence_Jijel.'</th>
                <th>'.$Agence_Oumbouaki.'</th>
                <th>'.$Agence_Taref.'</th>
            </tr>
        </table>
        ';
        }
        ?>
        </div><br>
    </div><br>
</body>
</html>