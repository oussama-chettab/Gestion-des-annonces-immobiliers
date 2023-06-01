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
    <title>Mes Favoris</title>
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
                <i class="fa-regular fa-user"></i> <?php echo $row['Nom']; ?> 
            </a>
        </div>
    </div>
    <h2 style="text-align: center; margin-top: 30px;">Mes Favoris</h2>
    <div class="annonce_valide">
        <?php
            $Id_U = $_SESSION['Id_U'];
            $sql = " SELECT * FROM favoris WHERE id_ut='$Id_U' ";
            $query = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($query)){
            $id_an = $row['id_an'];
            $query_info = mysqli_query($conn, " SELECT * FROM annonce WHERE id_A='$id_an'; ");
            while($data=mysqli_fetch_array($query_info)){
                $photo = $data['photo'];
                $photo_base64 = base64_encode($photo);
                $imagePath = 'annonce_images/' . basename($photo);
        ?>
        <div class="annonce">
            <div class="supp">
                <h3><a href="<?php echo $url; ?>"> <?php echo $data['type_annonce'].' '.$data['type_bien'] ;?></a></h3><br>
                <form method="POST" action="Suppr_fav.php">
                    <input type="hidden" name="annonceId" value="<?php echo $data['id_A']; ?>">
                    <button type="submit" name="supprimer" class="btn_supprimer"><i class="fa-solid fa-trash fa-2x"></i></button>
                </form>
            </div><br>
            <img src="data:image/jpeg;base64,<?php echo $photo_base64 ; ?>" alt="Image" class="img_A">            
            <div class="inf">
                <h4 style="color: rgba(20, 83, 154, 0.9);"><i class="fa-solid fa-location-dot"></i>Ville : <?php echo $data['ville'] ;?></h4><br>
                <h4><i class="fa-solid fa-tag"></i> <?php echo $data['titre'] ;?></h4><br>
                <h4>Surface : <?php echo $data['surface'] ;?> m²</h4><br>
                <h4><i class="fa-solid fa-city"></i>Etage : <?php echo $data['etage'] ;?></h4><br>
                <h4>Description : <br><?php echo $data['description'] ;?></h4><br>
                <h4 style="text-decoration:underline;">Plus caractéristiques :</h4><br>
                <h4> <?php if($data['chambres']!=''){
                echo 'Nombre des chambres : '.$data['chambres']; }?>
                </h4>
                <h4> <?php if($data['Meublé']== 1){
                echo '+ Meublé'; }?>
                </h4>
                <h4> <?php if($data['Electroménager']== 1){
                echo '+ Electroménager'; }?>
                </h4>
                <h4> <?php if($data['Jardin']== 1){
                echo '+ Jardin'; }?>
                </h4>
                <h4> <?php if($data['Piscine']== 1){
                echo '+ Piscine'; }?>
                </h4>
                <h4> <?php if($data['Garage']== 1){
                echo '+ Garage'; }?>
                </h4>
                <h4> <?php if($data['Parking']== 1){
                echo '+ Parking'; }?>
                </h4>
                <h4> <?php if($data['Espase_exterieure']== 1){
                echo '+ Espase exterieure'; }?>
                </h4>
            </div>
        </div>
        <?php     
            } 
        } 
        }
        ?>
    </div>
</body>
</html>