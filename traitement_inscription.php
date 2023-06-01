<?php
include('config.php');

if (isset($_POST['soumettre'])) {
    $nom = stripcslashes(strtolower($_POST['nom']));
    $prenom = stripcslashes(strtolower($_POST['prenom']));
    $adresse = stripcslashes(strtolower($_POST['adresse']));
    $email = stripcslashes($_POST['email']);
    $tel = stripcslashes($_POST['tel']);
    if(isset($_POST['ville'])){
        $ville = stripcslashes($_POST['ville']); 
        if(!in_array($ville,['Alger','Annaba','Constantine','Setif','Bejaia','Jijel','Oumbouaki','Taref'])){
            $ville_error = '<p id="error">choisez ville slvp !</p>';
            $err_s = 1;
        }      
    }
    $motdepasse = stripcslashes($_POST['motdepasse']);

    // Hashage du mot de passe
    $motdepasse_hashe = password_hash($motdepasse, PASSWORD_DEFAULT);

    $check_user = "SELECT * FROM `utilisateur` Where email='$email'";
    $check_result = mysqli_query($conn,$check_user);
    $num_rows = mysqli_num_rows($check_result);
    if($num_rows != 0){
        $email_error = '<p id="error">email est exister, changer ce chois</p>';
    }
    
    if(empty($nom)){
        $nom_error = '<p id="error">Entrer votre nom correct</p>';
        $err_s = 1;
    }elseif(strlen($nom) < 4){
        $user_error = '<p id="error">votre nom est court de 6 lettres</p>';
        $err_s = 1;
    }elseif(filter_var($nom,FILTER_VALIDATE_INT)){
        $nom_error = '<p id="error">entrer des lettres</p>';
        $err_s = 1;
    }

    if(empty($prenom)){
        $prenom_error = '<p id="error">Entrer votre prenom correct</p>';
        $err_s = 1;
    }elseif(strlen($prenom) < 4){
        $prenom_error = '<p id="error">votre prenom est court de 6 lettres</p>';
        $err_s = 1;
    }elseif(filter_var($prenom,FILTER_VALIDATE_INT)){
        $prenom_error = '<p id="error">entrer des lettres</p>';
        $err_s = 1;
    }

    if(empty($adresse)){
        $adresse_error = '<p id="error">Entrer votre adresse correct</p>';
        $err_s = 1;
    }elseif(filter_var($prenom,FILTER_VALIDATE_INT)){
        $adresse_error = '<p id="error">entrer des lettres</p>';
        $err_s = 1;
    }

    if(empty($email)){
        $email_error = '<p id="error">Entrer votre email</p>';
        $err_s = 1;
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_error = '<p id="error">Ecrit votre email correct</p>';
        $err_s = 1;
    }

    if(empty($tel)){
        $tel_error = '<p id="error">Entrer votre tel</p>';
        $err_s = 1;
    }

    if(empty($ville)){
        $ville_error = '<p id="error">Entrer votre ville</p>';
        $err_s = 1;
    }

    if(empty($motdepasse)){
        $pass_error = '<p id="error">Entrer votre mot de passe</p>';
        $err_s = 1;
        include('inscription.php');
    }elseif(strlen($motdepasse) < 8){
        $pass_error = '<p id="error">votre mot de passe est court de 8 caractères</p>';
        $err_s = 1;
        include('inscription.php');
    }else{
        if(($err_s == 0) && ($num_rows == 0)){
            $sql = "INSERT INTO utilisateur (Nom, prenom, adresse, email, tel, ville, motdepasse) 
            VALUES ('$nom', '$prenom', '$adresse', '$email', '$tel', '$ville', '$motdepasse')";
            mysqli_query($conn,$sql);
            header('location:connexion.php');
        }else{
            include_once('inscription.php');
        }
    }
}
?>